<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'slug',
        'purchase_price',
        'sale_price',
        'stock',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'purchase_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'stock' => 'integer',
    ];


    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class);
    }

    public function discounts()
    {
        return $this->belongsToMany(\App\Models\Discount::class);
    }

    public function images()
    {
        return $this->hasMany(\App\Models\ProductImage::class);
    }

    public function externalShops()
    {
        return $this->hasMany(\App\Models\ExternalShop::class);
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
}
