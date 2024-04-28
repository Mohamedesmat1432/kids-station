<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrdersExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */

    protected $search = '';

    public function __construct($search)
    {
        $this->search = $search;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'color' => ['#FFFF00' => true],
            ],
        ];
    }

    public function collection()
    {
        return Order::select('id', 'number', 'user_id', 'customer_name', 'customer_phone', 'duration', 'offer_id', 'visitors', 'total', 'remianing', 'last_number', 'last_total', 'start_date', 'end_date', 'status', 'note')
            ->where('number', 'like', '%' . $this->search . '%')
            ->orWhere('customer_name', 'like', '%' . $this->search . '%')
            ->orWhere('customer_phone', 'like', '%' . $this->search . '%')
            ->get();
    }

    public function headings(): array
    {
        return ['ID', 'Number', 'User Id', 'Customer Name', 'Customer Phone', 'Duration', 'Offer Id', 'Visitors', 'Total', 'Remianing', 'Last Number', 'Last Total', 'Start Date', 'End Date', 'Status', 'Note'];
    }
}
