<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    use HasFactory;
    protected $fillable = [
      'name',
      'desc'
    ];

    /*protected $hidden = [
        'created_at',
        'updated_at'
    ];*/

    public function categories()
    {
        return $this->belongsToMany(Category::class,'categories_lots','lot_id','category_id');
    }
}
