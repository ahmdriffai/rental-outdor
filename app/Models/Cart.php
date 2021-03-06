<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner', 'equipment_id', 'quantity'
    ];

    public function equipment() {
        return $this->belongsTo(Equipment::class);
    }
}
