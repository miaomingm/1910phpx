<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProlistController extends Controller
{
    public function prolist(){
        return view('index.prolist');
    }
}
