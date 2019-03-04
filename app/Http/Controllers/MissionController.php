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

    public function getStatuses($id){
        $mission=Mission::find($id);
        $statuses=$mission->steps()
            ->whereHas('statuses')
            ->with('statuses')
            ->get()
            ->pluck('statuses')
            ->collapse();
        
        $ratings=array('excellent'=>'','good'=>'','normal'=>'','bad'=>'','terrible'=>'');
        $total=count($statuses);
        foreach($statuses as $status){
            if($status['rating']==5) $ratings['excellent']++;
            else if( $status['rating'] == 4) $ratings['good']++;
            else if($status['rating'] == 3) $ratings['normal']++;
            else if($status['rating'] == 2) $ratings['bad']++;
            else $ratings['terrible']++;
        }

        $ratings['excellent']= round( $ratings['excellent'] / $total * 100,2);
        $ratings['good']= round( $ratings['good'] / $total * 100,2);
        $ratings['normal']= round( $ratings['normal'] / $total * 100,2);
        $ratings['bad']= round( $ratings['bad'] / $total * 100,2);
        $ratings['terrible']= round( $ratings['terrible'] / $total * 100,2);
        return $ratings;
    }

}
