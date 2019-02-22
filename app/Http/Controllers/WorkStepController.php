<?php

namespace App\Http\Controllers;
use App\Work;
use Illuminate\Http\Request;

class WorkStepController extends Controller
{
    public function index(Work $work){
        return $step=$work->step->name;
        
    }
}
