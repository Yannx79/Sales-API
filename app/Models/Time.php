<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    public function sales()
    {
        return $this->hasMany(Sales::class, 'time_id', 'id');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('active', 1);
    }

}
