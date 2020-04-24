<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weblist extends Model
{
    protected $table = 'Weblist';
    protected $primaryKey = 'web_id';

    public $timestamps = false;
    //黑名单
    protected $guarded = [];
}
