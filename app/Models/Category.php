<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='categories';
    protected $fillable = [
        'type'
    ];

    public function items()
    {
        return $this->hasMany('App\Models\Item', 'category_id', 'id');
    }
}
