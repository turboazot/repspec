<?php

namespace ArtemProger\Repspec\Test\Models;

use Illuminate\Database\Eloquent\Model;
use ArtemProger\Repspec\Test\Models\Comment;
use ArtemProger\Repspec\Test\Models\Tag;

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
