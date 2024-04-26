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
    public $note;
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
            'note' => 'nullable|string'
        ];
    }

    public function discount()
    {
        if ($this->offer_id) {
            $this->total -= Offer::findOrFail($this->offer_id)->price;
        }
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

            $this->discount();
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

        $this->discount();
    }

    public function setOrder($id)
    {
        $this->order = Order::withoutTrashed()->findOrFail($id);
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
        $this->note = $this->order->note ?? '';
    }

    public function showOrder($id)
    {
        $this->authorize('show-order-kids');

        $this->order = Order::with('offer')->findOrFail($id);
    }

    public function storeOrder()
    {
        $this->authorize('create-order-kids');
        $validated = $this->validate();
        $validated['number'] = '#' . random_int(1000000, 9999999);
        $validated['user_id'] = auth()->user()->id;
        $validated['start_date'] = Carbon::now();
        $validated['end_date'] = Carbon::now()->addMinutes($this->duration * 60);
        $validated['offer_id'] = $this->offer_id ? $this->offer_id : null;
        $validated['total'] = $this->total;
        $order = Order::create($validated);
        $this->reset();
        $this->fillRow();
        $this->dispatch('print-create-order-kids', id: $order->id);
        $this->dispatch('refresh-list-order-kids');
        $this->successNotify(__('site.order_created'));
        $this->create_modal = false;    
    }

    public function attachOrder()
    {
        $this->authorize('attach-order-kids');
        $validated = $this->validate();
        $validated['number'] = '#' . random_int(1000000, 9999999);
        $validated['user_id'] = auth()->user()->id;
        $validated['start_date'] = Carbon::now();
        $validated['end_date'] = Carbon::now()->addMinutes($this->duration * 60);
        $validated['last_number'] = $this->order->number;
        $validated['last_total'] = $this->order->total;
        $validated['remianing'] = $this->total - $this->order->total;
        $validated['offer_id'] = $this->offer_id ? $this->offer_id : null;
        $validated['total'] = $this->total;
        $order = Order::create($validated);
        $this->reset();
        $this->fillRow();
        $this->dispatch('print-attach-order-kids', id: $order->id);
        $this->dispatch('refresh-list-order-kids');
        $this->successNotify(__('site.order_updated'));
        $this->attach_modal = false;    
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
        $this->authorize('delete-order-kids');
        $order = Order::withoutTrashed()->findOrFail($id);
        $order->delete();
        $this->reset();
        $this->dispatch('refresh-list-order-kids');
        $this->successNotify(__('site.order_deleted'));
        $this->delete_modal = false;
    }

    public function checkboxAll()
    {
        $orders_trashed = Order::onlyTrashed()->pluck('id')->toArray();
        $orders = Order::withoutTrashed()->pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);
        $data = $this->trash ? $orders_trashed : $orders;

        if ($checkbox_count < 1 || $checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDeleteOrder($arr)
    {
        $this->authorize('bulk-delete-order-kids');
        $orders = Order::withoutTrashed()->whereIn('id', $arr);
        $orders->delete();
        $this->reset();
        $this->dispatch('refresh-list-order-kids');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.order_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function restoreOrder($id)
    {
        $this->authorize('restore-order-kids');
        $order = Order::onlyTrashed()->findOrFail($id);
        $order->restore();
        $this->reset();
        $this->dispatch('refresh-list-order-kids');
        $this->successNotify(__('site.order_restored'));
        $this->restore_modal = false;
    }

    public function forceDeleteOrder($id)
    {
        $this->authorize('force-delete-order-kids');
        $order = Order::onlyTrashed()->findOrFail($id);
        $order->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-order-kids');
        $this->successNotify(__('site.order_deleted'));
        $this->force_delete_modal = false;
    }

    public function forceBulkDeleteOrder($arr)
    {
        $this->authorize('force-bulk-delete-order-kids');
        $orders = Order::onlyTrashed()->whereIn('id', $arr);
        $orders->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-order-kids');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.order_delete_all'));
        $this->force_bulk_delete_modal = false;
    }
}
