<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'description', 'image_url', 'image_path', 'category_id'
    ];

    function category() {
        return $this->belongsTo(Category::class);
    }

    public function cart() {
        return $this->hasMany(Cart::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
}
