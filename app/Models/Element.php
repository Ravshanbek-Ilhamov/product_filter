<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $fillable = [
        'title',
        'product_id',
        'price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function attribute_charactiristics()
    {
        return $this->belongsToMany(AttributeCharactiristic::class,'options','element_id', 'attribute_charactiristics_id');
    }
}
