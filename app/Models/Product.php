<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    // protected $guarded = ['id'];

    protected $fillable = [
        'name', 'user_id', 'category_id', 'price', 'description', 'slug'
    ];

    protected $hidden = [];

    // protected $with = ['category', 'user'];

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class, 'product_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
