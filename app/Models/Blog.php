<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Conner\Tagging\Taggable;
class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'sub_category_id',
        'title',
        'short_description',
        'body',
        'slug',
        'image',
        'featured',
        'status'
    ];

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function subCategories()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }

}