<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mission;

class MissionWorksController extends Controller{

    public function index(Mission $mission){
        $listOfWorks=$mission->steps()
                    ->with('works')
                    ->get()
                    ->pluck('works')
                    ->collapse();
        return $listOfWorks;
    }
}
