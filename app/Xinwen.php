<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Xinwen extends Model
{
    protected $table = 'xinwen';
    protected $primaryKey = 'x_id';

    public $timestamps = false;
    //黑名单
    protected $guarded = [];
}
