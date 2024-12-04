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
        $sheet->getStyle('A1:Z' . Order::count() + 1)->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:Z1')->getFont()->setBold(true);
        return;
    }

    public function collection()
    {
        return Order::select('id', 'number', 'customer_name', 'customer_phone', 'duration', 'offer_id', 'total', 'remianing', 'last_number', 'last_total', 'created_at', 'start_date', 'end_date')
            ->search($this->search)
            ->get();
    }

    public function headings(): array
    {
        return ['ID', 'Order Number', 'Customer Name', 'Customer Phone', 'Duration', 'Offer Id', 'Total', 'Remianing', 'Last Order Number', 'Last Order Total', 'Order Date', 'Start Date', 'End Date'];
    }
}
