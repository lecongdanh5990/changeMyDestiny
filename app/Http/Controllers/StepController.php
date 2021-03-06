<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Step;

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request){
   
         return $step= Step::create([
            'startday' => $request->startday,
            'endday' => $request->endday,
            'name'=>$request['name'],
            'mission_id'=>$request['mission_id']
        ]);
        return $step;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $step=Step ::find($id);
        $step->name=$request->name;
        $step->endday = $request->endday;
        $step->mission_id=$request->mission_id;
        $step->save();
        return $step;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
