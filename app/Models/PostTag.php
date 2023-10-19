<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the posts for the tag.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the tag that owns the post tag.
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

}
