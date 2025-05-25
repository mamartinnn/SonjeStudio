<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class productImageModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'path',
        'caption',
        'order',
        'type',
        'is_featured'
    ];

    protected $table = 'product_images';

    public function product()
    {
        return $this->belongsTo(ProductModel::class);
    }
}
