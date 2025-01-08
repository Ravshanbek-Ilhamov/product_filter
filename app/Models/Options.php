<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected $fillable = [
        'element_id',
        'attribute_charactiristics_id',
    ];
}
