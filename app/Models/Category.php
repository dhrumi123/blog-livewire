<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'status'
    ];

    protected $appends = ['image_url'];
    
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/app/public/' . $this->image) : '';

    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}