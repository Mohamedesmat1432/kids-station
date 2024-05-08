<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class DailyExpenseProduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'data', 'total'];

    protected $casts = [
        'data' => 'array'
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('total', 'like', '%' . $search . '%');
        });
    }

    public function scopeSearchDate($query, $date)
    {
        return $query->where(function ($query) use ($date) {
            $query->where('created_at', 'like', '%' . $date . '%');
        });
    }

    public function scopeCountDailyExpenseProduct($query)
    {
        return auth()->user()->hasRole(['Super Admin', 'Admin'])
            ? $query->count()
            : auth()->user()->dailyExpenseProducts()->whereDate('created_at', Carbon::today())->count();
    }

    public function scopeTotalDailyExpenseProduct($query)
    {
        return auth()->user()->hasRole(['Super Admin', 'Admin'])
            ? $query->sum('total')
            : auth()->user()->dailyExpenseProducts()->whereDate('created_at', Carbon::today())->sum('total');
    }

    public function scopeDailyExpenseProductByMonth($query, $page)
    {
        return $query->select(DB::raw('sum(total) as total'), DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"))
            ->groupBy('months')->paginate($page);
    }
}
