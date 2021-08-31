<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'price' ,
        'quantity',
        'status' ,
        'brand_id' ,
        'subcategory_id' ,
        'supplier_id' ,
        'details' ,
        'image'
    ];

    public function getImageAttribute($value)
    {
        return url('/images/products') . '/' . $value;
    }

    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = ucfirst($value);
    }
}
