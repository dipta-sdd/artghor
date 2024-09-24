<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colorfamily extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'color_family',
        'color_code',
        'quantity',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
