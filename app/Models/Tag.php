<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'name',
    ];
    
    public function blogs()
    {
        return $this->belongsTo(Blog::class);
    }
}