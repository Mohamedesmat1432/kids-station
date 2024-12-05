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
    public $visitors = [['name' => '', 'type_id' => '', 'serial' => '', 'price' => 0]];
    public $total = 0;
    public $remianing = 0;
    public $last_number;
    public $last_total = 0;
    public $start_date;
    public $end_date;
    public $note;
    public $locker_number;
    public $insurance = 0;
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
            'visitors.*.serial' => 'nullable',
            'visitors.*.price' => 'required|numeric',
            // 'status' => 'required|in:inprogress,completed,completed_audit',
            'note' => 'nullable|string',
            'locker_number' => 'nullable|string',
            'insurance' => 'nullable|numeric',
        ];
    }

    public function typeDuration()
    {
        $durations = Type::active()->distinct()->whereNot('duration', 0)
            ->orderBy('duration', 'ASC')->pluck('duration');

        return $durations;
    }

    public function attachTypeDuration()
    {
        $typeId = array_unique(array_column($this->visitors,'type_id'));

        $typeNameIds = Type::active()->whereIn('id',$typeId)
            ->pluck('type_name_id')->toArray();

        $durations = Type::active()->whereNot('duration', 0)->whereIn('type_name_id', $typeNameIds)
            ->orderBy('duration', 'ASC')->pluck('duration');

        return $durations; 
    }

    public function uniqueTypes()
    {
        return Type::active()->whereIn('duration',[0, $this->duration, $this->order->duration ?? 0])
            ->orderBy('price', 'ASC')->get();

    }

    public function uniqueTypeNamesId()
    {
        return Type::active()->whereIn('duration',[0,$this->order->duration ?? 0])
            ->orderBy('price', 'ASC')->pluck('id')->toArray();

    }

    public function remove($key)
    {
        unset($this->visitors[$key]);
        $this->visitors = array_values($this->visitors);
        $this->totalVisitors();
    }

    public function add()
    {
        $this->visitors[] = ['name' => '', 'type_id' => '', 'serial' => '', 'price' => 0];
    }

    public function discount()
    {
        if ($this->offer_id) {
            $this->total -= Offer::findOrFail($this->offer_id)->price;
        }
    }

    public function refreshNewVisitor()
    {
        $this->visitors = array_map(function ($visitor) {
            $visitor['type_id'] = '';
            $visitor['price'] = number_format(0, 2);
            $this->total = number_format(0, 2);

            return $visitor;
        }, $this->visitors);
    }

    public function refreshAttachVisitors()
    {
        if ($this->duration < $this->order->duration) {
            $this->setOrder($this->order->id);
            $this->errorNotify(__('site.failed_duration'));
        } else {
            $this->total = number_format(0, 2);

            $this->visitors = array_map(function ($visitor) {
                if ($visitor) {
                    $unique_types = Type::whereIn('duration', [$this->duration, 0])
                        ->orderBy('price', 'ASC')->get();

                    $type_name = Type::find($visitor['type_id'])->typeName->name;

                    foreach ($unique_types as $type) {
                        if ($type->typeName->name === $type_name && $type->duration === $this->duration && $type->duration !== 0) {
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
            }, $this->visitors);

            $this->discount();
        }
    }

    public function totalVisitors()
    {
        $this->total = number_format(0, 2);

        if ($this->duration) {
            $this->visitors = array_map(function ($visitor) {
                if ($visitor['type_id']) {
                    $visitor['price'] = Type::find($visitor['type_id'])->price;
                    $this->total += $visitor['price'];
                } else {
                    $visitor['price'] = number_format(0, 2);
                }
                return $visitor;
            }, $this->visitors);
        }

        $this->discount();
    }

    public function visitorType($id)
    {
        $visitor_type = Type::findOrFail($id);

        return $visitor_type->typeName->name ?? '';
    }

    public function priceOffer($id)
    {
        $offer = Offer::findOrFail($id);

        return $offer->price ?? number_format(0, 2);
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
        $this->visitors = $this->order->visitors;
        $this->total = $this->order->total;
        $this->start_date = $this->order->start_date;
        $this->end_date = $this->order->end_date;
        $this->offer_id = $this->order->offer_id ?? null;
        $this->last_number = $this->order->last_number ?? '';
        $this->last_total = $this->order->last_total ?? 0;
        $this->remianing = $this->order->remianing ?? 0;
        $this->status = $this->order->status;
        $this->note = $this->order->note ?? '';
        $this->locker_number = $this->order->locker_number ?? '';
        $this->insurance = $this->order->insurance ?? 0;
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
        $this->dispatch('print-create-order-kids', id: $order->id);
        $this->dispatch('refresh-list-order-kids');
        $this->successNotify(__('site.order_created'));
        $this->create_modal = false;
    }

    public function storeExistsOrder()
    {
        $this->authorize('create-exists-order-kids');
        $validated = $this->validate();
        $validated['number'] = '#' . random_int(1000000, 9999999);
        $validated['user_id'] = auth()->user()->id;
        $validated['start_date'] =  Carbon::now();
        $validated['end_date'] = Carbon::now()->addMinutes($this->duration * 60);
        $validated['offer_id'] = $this->offer_id ? $this->offer_id : null;
        $validated['total'] = $this->total;
        $order = Order::create($validated);
        $this->dispatch('print-create-exists-order-kids', id: $order->id);
        $this->dispatch('refresh-list-order-kids');
        $this->successNotify(__('site.order_created'));
        $this->create_exists_modal = false;
        $this->reset();
    }

    public function updateOrder()
    {
        $this->authorize('edit-order-kids');
        $validated = $this->validate();
        $this->order->update($validated);
        $this->dispatch('print-update-order-kids', id: $this->order_id);
        $this->dispatch('refresh-list-order-kids');
        $this->successNotify(__('site.order_updated'));
        $this->edit_modal = false;
        $this->reset();
    }

    public function attachOrder()
    {
        $this->authorize('attach-order-kids');
        $validated = $this->validate();
        $validated['number'] = '#' . random_int(1000000, 9999999);
        $validated['user_id'] = auth()->user()->id;
        $validated['start_date'] = $this->order->start_date;
        $validated['end_date'] = $this->order->start_date->addMinutes($this->duration * 60);
        $validated['last_number'] = $this->order->number;
        $validated['last_total'] = $this->order->total;
        $validated['remianing'] = $this->total - $this->order->total;
        $validated['offer_id'] = $this->offer_id ? $this->offer_id : null;
        $validated['total'] = $this->total;
        $order = Order::create($validated);
        $this->dispatch('print-attach-order-kids', id: $order->id);
        $this->dispatch('refresh-list-order-kids');
        $this->successNotify(__('site.order_updated'));
        $this->attach_modal = false;
        $this->reset();
    }

    public function deleteOrder($id)
    {
        $this->authorize('delete-order-kids');
        $order = Order::withoutTrashed()->findOrFail($id);
        $order->delete();
        $this->dispatch('refresh-list-order-kids');
        $this->successNotify(__('site.order_deleted'));
        $this->delete_modal = false;
        $this->reset();
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

    public function noteOrders($arr) {
        $this->validate(['note' => 'required|string']);
        $orders = Order::withoutTrashed()->whereIn('id', $arr);
        $orders->update(['note' => $this->note]);
        $this->reset();
        $this->dispatch('refresh-list-order-kids');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.note_orders_updated'));
        $this->note_modal = false;
    }
}
