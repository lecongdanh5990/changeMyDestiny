<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mission;
use Faker\Provider\zh_TW\DateTime;

class MissionController extends Controller{
    public function index()
    {
        return Mission::all();
    }

    
    public function create()
    {
        
    }

    public function store(Request $request){
        return $mission= Mission::create([
            'startday' => $request->startday,
            'endday' => $request->endday,
            'name'=>$request['name'],
        ]);
        return $mission;
    }

    public function show($id)
    {
        $mission=Mission::find($id);
        return $mission;
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        $mission=Mission::find($id);
        $mission->name=$request->name;
        $mission->endday = $request->endday;
        $mission->save();
        return $mission;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $mission=Mission::find($id);
        $mission->delete();
    }

    public function today()
    {
        $missions = Mission::where('endday', '>', date("Y-m-d"))
            ->orderBy('name', 'desc')
            ->get();
        for ($i = 0; $i < count($missions); $i++) {
            $dateEndMission = strtotime($missions[$i]->endday);
            $date = strtotime(date("Y-m-d"));
            $missions[$i]['missiondayleft'] = ($dateEndMission - $date) / 86400;

            

        }
        return $missions;
    }

}
