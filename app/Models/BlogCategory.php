<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'category_desc',
    ];

    /**
     * Get the blog posts associated with the category.
     */
    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class);
    }
}
