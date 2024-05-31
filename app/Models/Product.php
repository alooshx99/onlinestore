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

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($product)
        {
            $product->transactions()->delete();
        }
        );

    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

}
