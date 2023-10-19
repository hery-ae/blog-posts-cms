<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the post tags for the post.
     */
    public function postTags()
    {
        return $this->hasMany(PostTag::class);
    }

    /**
     * Get the tag that owns the post tag.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tag that owns the post tag.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
