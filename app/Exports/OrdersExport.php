<?php

namespace App\Exports;

use App\Helpers\Helper;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrdersExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithMapping
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
        return Order::search($this->search)->get();
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->number,
            $order->customer_name,
            $order->customer_phone,
            $order->duration,
            $order->offer_id,
            $order->total,
            $order->remianing,
            $order->last_number,
            $order->last_total,
            Helper::formatDate($order->created_at),
            Helper::formatHours($order->start_date),
            Helper::formatHours($order->end_date),
        ];
    }

    public function headings(): array
    {
        return ['ID', 'Order Number', 'Customer Name', 'Customer Phone', 'Duration', 'Offer Id', 'Total', 'Remianing', 'Last Order Number', 'Last Order Total', 'Order Date', 'Start Date', 'End Date'];
    }
}
