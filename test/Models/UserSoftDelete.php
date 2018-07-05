<?php

namespace ArtemProger\Test\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserSoftDelete extends Model {

    use SoftDeletes;

    /**
     * @var $table string
     */
    protected $table = 'users';
}
