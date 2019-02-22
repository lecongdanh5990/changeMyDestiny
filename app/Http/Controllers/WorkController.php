<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Work;

class WorkController extends Controller{
    
    public function index()
    {
        $works=Work::all();
    }

    public function showToday(){
        $works = Work::whereDate('created_at', '=', date('Y-m-d'))
            ->where('iscomplete', '=', 0)
            ->get();
        for($i=0;$i<count($works);$i++){
            $works[$i]['stepname']=$works[$i]->step->name;
            $works[$i]['missionname'] = $works[$i]->step->mission->name;
        }
        return $works;
    }

    public function showCompleted(){
        $works = Work::where('iscomplete', '=', 1)
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->orderBy('name', 'desc')
            ->get();
        for($i=0;$i<count($works);$i++){
            $works[$i]['stepname']=$works[$i]->step->name;
            $works[$i]['missionname'] = $works[$i]->step->mission->name;
        }
        return $works;
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $work = new Work();
        $work->name = $request->name;
        $work->description = $request->description;
        $work->step_id = $request->step_id;
        $work->save();
        return $work;
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

    public function update(Request $request, $id){
        $work=Work::find($id);
        $work->update($request->all());
        return $work;
    }
    
    public function destroy($id)
    {
        $work=Work::find($id);
        $work->delete();

    }
}
