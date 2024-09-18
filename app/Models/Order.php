<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'user_id',
        'total',
        'delevery_fee',
        'payment_type',
        'bkash_no',
        'trans_id',
        'name',
        'mobile',
        'district',
        'thana',
        'area',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
