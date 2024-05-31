<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        ];


    public static function boot()
    {
        parent::boot();
        static::deleting(function ($category) {
            foreach ($category->products as $product) {
                $product->delete();
            };
        });

    }

    public function products(){
        return $this->hasMany(Product::class);
    }

}
