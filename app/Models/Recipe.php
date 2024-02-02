<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'rating',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function tags()
    {   
        return $this->belongsToMany(Tags::class, 'recipe_tags', 'recipe_id', 'tag_id');
    }

    public function recipe_tags()
    {
        return $this->belongsToMany(RecipeTags::class, 'recipe_tags');
    }
    

}
