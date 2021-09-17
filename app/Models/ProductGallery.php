<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'photo', 'product_id'
    ];

    protected $hidden = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
