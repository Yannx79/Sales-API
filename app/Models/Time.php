<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    public function sales()
    {
        return $this->hasMany(Sales::class, 'time_id', 'id');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('state', 1);
    }

    public function scopeLastMonth(Builder $query)
    {
        $currentDate = Carbon::now();
        $currentDate->day(1);
        $query->where('date', '>=', $currentDate);
    }

    public function scopeSalesYear(Builder $query, string $date)
    {
        $saleDate = Carbon::parse($date);
        $query->whereYear('date', $saleDate->year);
    }

    public function scopeSalesMonthYear(Builder $query, string $date)
    {
        $saleDate = Carbon::parse($date);
        $query->whereYear('date', $saleDate->year)->whereMonth('date', $saleDate->month);
    }
}
