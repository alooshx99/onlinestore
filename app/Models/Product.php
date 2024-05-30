<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'quantity',
        'category_id',
        'image_url'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

}
