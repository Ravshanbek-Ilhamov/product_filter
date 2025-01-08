<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeCharactiristic extends Model
{
    protected $fillable = [
        'attribute_id',
        'characteristic_id',
    ];

    public function elements(){
        return $this->belongsToMany(Element::class, 'options', 'attribute_charactiristics_id', 'element_id');
    }

    public function characteristic(){
        return $this->belongsTo(Characteristic::class,'characteristic_id');
    }


    public function attribute(){
        return $this->belongsTo(Atribute::class,'attribute_id');
    }
}
