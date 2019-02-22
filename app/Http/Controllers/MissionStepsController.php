<?php

namespace App\Http\Controllers;

use App\Mission;
use Illuminate\Http\Request;

class MissionStepsController extends Controller
{
    public function index(Mission $mission){
        return $steps=$mission->steps;
    }
    public function today(Mission $mission){
        return $steps = $mission->steps()
            ->where('startday', '<=', date('Y-m-d'))
            ->get();
    }  
}
