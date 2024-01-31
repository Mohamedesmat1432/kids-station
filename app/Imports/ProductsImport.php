<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([
            'name' => $row['name'],
            'description' => $row['description'],
            'price' => $row['price'],
            'purchase_price' => $row['purchase_price'],
            'revenue_price' => $row['revenue_price'],
            'qty' => $row['qty'],
            'unit_id' => $row['unit_id'],
            'category_id' => $row['category_id'],
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:products,name'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
            'purchase_price' => ['required', 'numeric'],
            'revenue_price' => ['required', 'numeric'],
            'qty' => ['required', 'numeric'],
            'unit_id' => ['required', 'numeric', 'exists:units,id'],
            'category_id' => ['required', 'numeric', 'exists:categories,id'],
        ];
    }
}
