<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\Tag;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded =  [];
    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id');
        // one to Many
        //related : ProductImage && foreignkey : product_id
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'product_tags','product_id','tag_id')->withTimestamps();
        // many to many
        //related : Tag && table : product_tags && foreignPivotKey : product_id && relatedPivotKey : tag_id
    }
    public function categoryProduct()
    {
        return $this->belongsTo(Category::class,'category_id');
        // many to One
        //related : Category && foreignkey : category_id
    }
}
