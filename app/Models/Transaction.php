<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'inscurence_price',
        'shipping_price',
        'total_price',
        'transaction_status'
    ];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
