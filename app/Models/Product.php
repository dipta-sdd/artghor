<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'category_id',
        'subcategory_id',
        'image1',
        'image2',
        'image3',
        'image4',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function colorfamilies()
    {
        return $this->hasMany(Colorfamily::class);
    }
}
