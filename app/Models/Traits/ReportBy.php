<?php

namespace App\Models\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait ReportBy
{
    public function scopeYear(Builder $query, $value)
    {
        $query->whereYear('created_at', $value);
    }

    public function scopeMonth(Builder $query, $value)
    { 
        $query->whereMonth('created_at', $value);
    }
    public function scopeToday(Builder $query,$value)
    {   
        
        $query->whereDate('created_at',Carbon::now()->format('Y-m-d'));

    }
    public function scopeCurrentMonth(Builder $query,$value){
        $query->whereMonth('created_at',Carbon::now()->month);
    }
    public function scopeStatus(Builder $query,$value){
        $query->where('status',$value);
    }
    public function scopeWeek(Builder $query,$value){
        $query->whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }

    public function scopeTotal(Builder $query)
    {
        $query->select(DB::raw('sum(total) as total'));
    }
}
