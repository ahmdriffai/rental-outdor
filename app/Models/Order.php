<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner', 'rental_start', 'rental_end', 'status'
    ];

    public function equipment() {
        return $this->belongsToMany(Equipment::class,'equipment_order')->withPivot('quantity');
    }
}
