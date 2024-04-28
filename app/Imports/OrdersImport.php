<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class OrdersImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Order([
            'number' => $row['number'],
            'user_id' => $row['user_id'],
            'customer_name' => $row['customer_name'],
            'customer_phone' => $row['customer_phone'],
            'duration' => $row['duration'],
            'offer_id' => $row['offer_id'],
            'visitors' => $row['visitors'],
            'total' => $row['total'],
            'remianing' => $row['remianing'],
            'last_number' => $row['last_number'],
            'last_total' => $row['last_total'],
            'start_date' => $row['start_date'],
            'end_date' => $row['end_date'],
            'status' => $row['status'],
            'note' => $row['note'],
        ]);
    }

    public function rules(): array
    { 
        return [
            'number' => 'required|string',
            'user_id' => 'required|numeric',
            'customer_name' => 'required|string|min:2|max:20',
            'customer_phone' => 'required|numeric|min:6',
            'duration' => 'required|numeric',
            'offer_id' => 'nullable|numeric|exists:offers,id',
            'visitors' => 'required',
            'total' => 'required|numeric',
            'remianing' => 'nullable|numeric',
            'last_number' => 'nullable|string',
            'last_total' => 'nullable|numeric',
            'start_date' => 'required|datetime',
            'end_date' => 'required|datetime',
            'status' => 'required|in:inprogress,completed,completed_audit',
            'note' => 'nullable|string',
        ];
    }
}
