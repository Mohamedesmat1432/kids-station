<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ProductOrder extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'product_orders';

    protected $fillable = ['number', 'user_id', 'products', 'total', 'status'];

    protected $casts = [
        'products' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('total', 'like', '%' . $search . '%')
                ->orWhere('products', 'like', '%' . $search . '%');
        });
    }

    public function scopeSearchDate($query, $date)
    {
        return $query->where(function ($query) use ($date) {
            $query->where('created_at', 'like', '%' . $date . '%');
        });
    }

    public function scopeCountProductOrder($query)
    {
        return auth()->user()->hasRole(['Super Admin', 'Admin'])
            ? $query->count()
            : auth()->user()->productOrders()->whereDate('created_at', Carbon::today())->count();
    }

    public function scopeTotalProductOrder($query)
    {
        return auth()->user()->hasRole(['Super Admin', 'Admin'])
            ? $query->sum('total')
            : auth()->user()->productOrders()->whereDate('created_at', Carbon::today())->sum('total');
    }

    public function scopeProductOrderByMonth($query, $page)
    {
        return $query->select(DB::raw('sum(total) as total'), DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"))
            ->groupBy('months')->paginate($page);
    }
}
