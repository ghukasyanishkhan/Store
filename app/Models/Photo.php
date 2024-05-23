<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $table='photos';
    protected $fillable = [
        'path'
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id', 'id');
    }
}
