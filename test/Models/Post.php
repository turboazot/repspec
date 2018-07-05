<?php

namespace ArtemProger\Test\Models;

use Illuminate\Database\Eloquent\Model;
use ArtemProger\Test\Models\Comment;
use ArtemProger\Test\Models\Tag;

class Post extends Model {

    /**
     * @var $table string
     */
    protected $table = 'posts';

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function tags()
    {
        return $this->belongsTo(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }
}
