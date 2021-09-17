<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'transaction_id',
        'product_id',
        'price',
        'shipping_status',
        'resi',
    ];

    protected $hidden = [];

    public function product()
    {
        // return $this->hasOne(Product::class);
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function transaction()
    {
        // return $this->hasOne(Transaction::class);
        return $this->hasOne(Transaction::class, 'id', 'transaction_id');
    }
}
