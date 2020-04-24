<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';
    protected $primaryKey = 'id';

    public $timestamps = false;
    //黑名单
    protected $guarded = [];
}
