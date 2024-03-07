<?php

namespace App\Traits;

use App\Models\Offer;
use App\Models\Order;
use App\Models\Type;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

trait OrderTrait
{
    use WithNotify, SortSearchTrait, WithPagination, ModalTrait, WithFileUploads;

    public ?Order $order;
    public $order_id;
    public $number;
    public $user_id;
    public $customer_name;
    public $customer_phone;
    public $duration;
    public $offer_id;
    public $visitors;
    public $total = 0;
    public $remianing = 0;
    public $last_number;
    public $last_total = 0;
    public $start_date;
    public $end_date;
    public $status;
    public $checkbox_arr = [];
    public $file;
    public $extension = 'xlsx';

    protected function rules()
    {
        return [
            'customer_name' => 'required|string|min:2|max:20',
            'customer_phone' => 'required|numeric|min:6',
            'duration' => 'required|string',
            'offer_id' => 'nullable|numeric|exists:offers,id',
            'visitors.*.name' => 'required|string|min:2|max:20',
            'visitors.*.type_id' => 'required|numeric|exists:types,id',
            'visitors.*.serial' => 'required|string|min:2|max:20',
            'visitors.*.price' => 'required|numeric',
            // 'status' => 'required|in:inprogress,completed,completed_audit',
        ];
    }

    public function refreshNewVisitor()
    {
        $this->visitors = $this->visitors->map(function ($visitor) {
            $visitor['type_id'] = '';
            $visitor['price'] = number_format(0, 2);
            $this->total += $visitor['price'];

            return $visitor;
        });
    }

    public function refreshAttachVisitors()
    {
        if ($this->duration < $this->order->duration) {
            $this->setOrder($this->order->id);
            $this->errorNotify(__('site.failed_duration'));
        } else {
            $this->total = number_format(0, 2);

            $this->visitors = $this->visitors->map(function ($visitor) {
                if ($visitor) {
                    $unique_types = Type::whereIn('duration', [$this->duration, 0])
                        ->orderBy('price', 'ASC')
                        ->get();

                    $type_id = Type::find($visitor['type_id'])->typeName->name;

                    foreach ($unique_types as $type) {
                        if ($type->typeName->name === $type_id && $type->duration === $this->duration && $type->duration !== 0) {
                            $visitor['type_id'] = $type->id;
                            $visitor['price'] = $type->price;
                        }
                    }
                } else {
                    $visitor['type_id'] = '';
                    $visitor['price'] = number_format(0, 2);
                }

                $this->total += $visitor['price'];
                return $visitor;
            });

            if ($this->offer_id) {
                $this->total -= Offer::findOrFail($this->offer_id)->price;
            }
        }
    }

    public function discount()
    {
        if ($this->offer_id) {
            $this->total -= Offer::findOrFail($this->offer_id)->price;
        }
    }

    public function totalVisitors()
    {
        $this->total = number_format(0, 2);

        if ($this->duration) {
            $this->visitors = $this->visitors->map(function ($visitor) {
                if ($visitor['type_id']) {
                    $visitor['price'] = Type::find($visitor['type_id'])->price;
                    $this->total += $visitor['price'];
                } else {
                    $visitor['price'] = number_format(0, 2);
                }
                return $visitor;
            });
        }

        if ($this->offer_id) {
            $this->total -= Offer::findOrFail($this->offer_id)->price;
        }
    }

    public function setOrder($id)
    {
        $this->order = Order::findOrFail($id);
        $this->order_id = $this->order->id;
        $this->number = $this->order->number;
        $this->user_id = $this->order->user_id;
        $this->customer_name = $this->order->customer_name;
        $this->customer_phone = $this->order->customer_phone;
        $this->duration = $this->order->duration;
        $this->visitors = collect($this->order->visitors);
        $this->total = $this->order->total;
        $this->start_date = $this->order->start_date;
        $this->end_date = $this->order->end_date;
        $this->offer_id = $this->order->offer_id ?? null;
        $this->last_number = $this->order->last_number ?? '';
        $this->last_total = $this->order->last_total ?? 0;
        $this->remianing = $this->order->remianing ?? 0;
        $this->status = $this->order->status;
    }

    public function showOrder($id)
    {
        $this->order = Order::with('offer')->findOrFail($id);
    }

    public function storeOrder()
    {
        $validated = $this->validate();
        $validated['number'] = '#' . random_int(1000000, 9999999);
        $validated['user_id'] = auth()->user()->id;
        $validated['start_date'] = Carbon::now();
        $validated['end_date'] = Carbon::now()->addHours($this->duration);
        $validated['offer_id'] = $this->offer_id ? $this->offer_id : null;
        $validated['total'] = $this->total;
        Order::create($validated);
        $this->reset();
        $this->fillRow();
    }

    public function attachOrder()
    {
        $validated = $this->validate();
        $validated['number'] = '#' . random_int(1000000, 9999999);
        $validated['user_id'] = auth()->user()->id;
        $validated['start_date'] = Carbon::now();
        $validated['end_date'] = Carbon::now()->addHours($this->duration);
        $validated['last_number'] = $this->order->number;
        $validated['last_total'] = $this->order->total;
        $validated['remianing'] = $this->total - $this->order->total;
        $validated['offer_id'] = $this->offer_id ? $this->offer_id : null;
        $validated['total'] = $this->total;
        Order::create($validated);
        $this->reset();
        $this->fillRow();
    }

    public function remove($key)
    {
        $this->visitors->pull($key);
        $this->totalVisitors();
    }

    public function add()
    {
        $this->visitors->push(['name' => '', 'type_id' => '', 'serial' => '', 'price' => 0]);
    }

    public function fillRow()
    {
        $this->visitors = collect([['name' => '', 'type_id' => '', 'serial' => '', 'price' => 0]]);
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
    }

    public function checkboxAll()
    {
        $orders_trashed = Order::onlyTrashed()->pluck('id')->toArray();
        $orders = Order::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);
        $data = $this->trashed ? $orders_trashed : $orders;

        if ($checkbox_count < 1 || $checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDeleteOrder()
    {
        $orders = Order::whereIn('id', $this->checkbox_arr);
        $orders->delete();
    }

    public function orderList()
    {
        return cache()->remember('orders', 1, function () {
            (auth()->user()->hasRole(['Super Admin', 'Admin']))
                ? $orders = $this->trashed ? Order::onlyTrashed() : new Order()
                : $orders = $this->trashed ? auth()->user()->orders()->onlyTrashed() : auth()->user()->orders();
                
            return $orders->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('number', 'like', '%' . $this->search . '%')
                        ->orWhere('customer_name', 'like', '%' . $this->search . '%')
                        ->orWhere('customer_phone', 'like', '%' . $this->search . '%')
                        ->orWhere('visitors', 'like', '%' . $this->search . '%')
                        ->orWhere('total', 'like', '%' . $this->search . '%');
                });
            })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });
    }

    public function restoreOrder($id)
    {
        $order = Order::onlyTrashed()->findOrFail($id);
        $order->restore();
    }

    public function forceDeleteOrder($id)
    {
        $order = Order::onlyTrashed()->findOrFail($id);
        $order->forceDelete();
    }

    public function forceBulkDeleteOrder()
    {
        $orders = Order::onlyTrashed()->whereIn('id', $this->checkbox_arr);
        $orders->forceDelete();
    }
}
