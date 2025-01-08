<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atribute extends Model
{
    protected $fillable = [
        'name',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function characteristics()
    {
        return $this->belongsToMany(Characteristic::class, 'attribute_charactiristics', 'attribute_id', 'characteristic_id');
    }
}
