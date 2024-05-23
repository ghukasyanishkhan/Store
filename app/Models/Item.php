<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table='items';
    protected $fillable = [
        'name',
        'description',
        'price'
    ];

    public function photos()
    {
        return $this->hasMany('App\Models\Photo', 'item_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
}
