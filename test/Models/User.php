<?php

namespace ArtemProger\Test\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model {

    /**
     * @var $table string
     */
    protected $table = 'users';

    public function scopeByActive()
    {
        return $query->where('is_active', true);
    }
}
