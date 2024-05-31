<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'title',
        ];

    protected $table = 'categories';

    /*public static function boot()
    {
        parent::boot();
        static::deleting(function ($category) {
            foreach ($category->products as $product) {
                $product->delete();
            };
        });

    }*/

    public function products(){
        return $this->hasMany(Product::class);
    }

}
