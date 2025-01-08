<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    protected $fillable = [
        'name',
    ];

    public function attributes()
    {
        return $this->belongsToMany(Atribute::class, 'attribute_charactiristics', 'characteristic_id', 'attribute_id');
    }
}
