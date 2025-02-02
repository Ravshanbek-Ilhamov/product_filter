<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    public function attributes()
    {
        return $this->hasMany(Atribute::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
