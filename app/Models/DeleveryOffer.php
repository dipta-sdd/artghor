<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeleveryOffer extends Model
{
    use HasFactory;
    protected $fillable = [
        'fee',
        'offer_at',
        'offer',
    ];
}
