<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $primaryKey = 'address_id';

    public $timestamps = false;
    //黑名单
    protected $guarded = [];
}
