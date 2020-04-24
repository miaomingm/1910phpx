<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reg extends Model
{
    protected $table = 'Reg';
    protected $primaryKey = 'reg_id';

    public $timestamps = false;
    //黑名单
    protected $guarded = [];
}
