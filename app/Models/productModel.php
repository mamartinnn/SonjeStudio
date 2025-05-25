<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock'
    ];

    protected $table = 'products';

    public function images()
    {
        return $this->hasMany(ProductImageModel::class);
    }

    public function featuredImage()
    {
        return $this->hasOne(ProductImageModel::class)->where('is_featured', true);
    }
}


