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

    protected $fillable = ['number', 'user_id', 'customer_name', 'customer_phone', 'duration', 'offer_id', 'visitors', 'total', 'remianing', 'last_number', 'last_total', 'start_date', 'end_date', 'status', 'note'];

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
        return $this->belongsTo(Type::class, 'visitors');
    }

    public function scopeSearch($query, $search, $date)
    {
        return $query->when($search, function ($query) use ($search) {
            $query->where('visitors', 'like', "%{$search}%")
                ->orWhere('number', 'like', "%{$search}%")
                ->orWhere('customer_name', 'like', "%{$search}%")
                ->orWhere('customer_phone', 'like', "%{$search}%")
                ->orWhere('total', 'like', "%{$search}%");
        })->when($date, function ($query) use ($date) {
            $query->whereDate('created_at', $date);
        });
    }

    public function scopeCountOrder($query)
    {
        return auth()->user()->hasRole(['Super Admin', 'Admin'])
            ? $query->count()
            : auth()->user()->orders()->whereDate('created_at', Carbon::today())->count();
    }

    public function scopeTotalOrder($query)
    {
        $orders_user = auth()->user()->orders()->whereDate('created_at', Carbon::today());

        return auth()->user()->hasRole(['Super Admin', 'Admin'])
            ? $query->sum('total') - $query->sum('last_total')
            : $orders_user->sum('total') - $orders_user->sum('last_total');
    }

    public function scopeTodayCountOrder($query)
    {
        return $query->whereDate('created_at', Carbon::today())->count();
    }

    public function scopeTodayTotalOrder($query)
    {
        return $query->whereDate('created_at', Carbon::today())->sum('total') - $query->whereDate('created_at', Carbon::today())->sum('last_total');
    }

    public function scopeOrderByMonth($query, $page)
    {
        return $query->select(DB::raw('sum(total) as total'), DB::raw('sum(last_total) as last_total'), DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"))
            ->groupBy('months')->paginate($page);
    }
}
