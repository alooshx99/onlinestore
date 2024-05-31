<?php

namespace App\Models;

use App\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'quantity',
        'category_id',
        'image_url',
        'status'
    ];

    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    protected $casts = [
        'status' => ProductStatusEnum::class
    ];

}
