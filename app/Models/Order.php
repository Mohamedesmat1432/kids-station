<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'number', 
        'user_id', 
        'customer_name', 
        'customer_phone', 
        'duration', 
        'offer_id', 
        'visitors', 
        'total', 
        'remianing', 
        'last_number', 
        'last_total', 
        'start_date', 
        'end_date', 
        'status', 
        'note',
        'locker_number',
        'insurance',
    ];

    protected $casts = [
        'start_date' => 'datetime: H:i',
        'end_date' => 'datetime: H:i',
        'visitors' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'visitors->type_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query) use ($search) {
            $query->where('number', 'like', "%{$search}%")
                ->orWhere('customer_name', 'like', "%{$search}%")
                ->orWhere('customer_phone', 'like', "%{$search}%");
        });
    }

    public function scopeDateSearch($query, $date)
    {
        return $query->when($date, function ($query) use ($date) {
            $query->whereDate('created_at', $date);
        });
    }

    public function scopeChildSearch($query, $child_search)
    {
        return $query->when($child_search, function ($query) use ($child_search) {
            $query->where('visitors', 'like', "%{$child_search}%");
        });
    }

    public function scopeCountOrder($query)
    {
        return auth()->user()->hasRole(['Super Admin', 'Admin'])
            ? $query->count()
            : auth()->user()->orders()->whereDate('created_at', Carbon::today())->count();
    }

    public function scopeCountWithoutAttachOrder($query)
    {
        return auth()->user()->hasRole(['Super Admin', 'Admin'])
            ? $query->whereNull('last_total')->count()
            : auth()->user()->orders()->whereDate('created_at', Carbon::today())->whereNull('last_total')->count();
    }

    public function scopeCountAttachOrder($query)
    {
        return auth()->user()->hasRole(['Super Admin', 'Admin'])
            ? $query->whereNotNull('last_total')->count()
            : auth()->user()->orders()->whereDate('created_at', Carbon::today())->whereNotNull('last_total')->count();
    }

    public function scopeTotalOrder($query)
    {
        $orders_user = auth()->user()->orders()->whereDate('created_at', Carbon::today());

        return auth()->user()->hasRole(['Super Admin', 'Admin'])
            ? $query->sum('total') - $query->sum('last_total')
            : $orders_user->sum('total') - $orders_user->sum('last_total');
    }

    public function scopeTotalAttachOrder($query)
    {
        $orders_user = auth()->user()->orders()->whereDate('created_at', Carbon::today());

        return auth()->user()->hasRole(['Super Admin', 'Admin'])
            ? $query->sum('last_total')
            : $orders_user->sum('last_total');
    }

    public function scopeTotalWithoutAttachOrder($query)
    {
        $orders_user = auth()->user()->orders()->whereDate('created_at', Carbon::today());

        return auth()->user()->hasRole(['Super Admin', 'Admin'])
            ? $query->whereNull('last_total')->sum('total')
            : $orders_user->whereNull('last_total')->sum('total');
    }

    public function scopeTodayCountOrder($query)
    {
        return $query->whereDate('created_at', Carbon::today())->count();
    }

    public function scopeTodayCountAttachOrder($query)
    {
        return $query->whereDate('created_at', Carbon::today())->whereNotNull('last_total')->count();
    }

    public function scopeTodayTotalOrder($query)
    {
        return $query->whereDate('created_at', Carbon::today())->sum('total') - $query->whereDate('created_at', Carbon::today())->sum('last_total');
    }

    public function scopeTodayTotalAttchOrder($query)
    {
        return $query->whereDate('created_at', Carbon::today())->whereNotNull('last_total')->sum('last_total');
    }

    public function scopeOrderByMonth($query, $page)
    {
        return $query->select(DB::raw('sum(total) as total'), DB::raw('sum(last_total) as last_total'), DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"))
            ->groupBy('months')->paginate($page);
    }
}
