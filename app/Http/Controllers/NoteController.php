<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\Mission;
use App\Work;

class NoteController extends Controller
{
    public function index()
    {
        
    }

    public function today(){
        $notes = Note::whereDate('created_at', '=', date("Y-m-d"))
            ->get();
        return $notes;
    }

    public function getNotesOfMission(){
        //get list of work in this mission
        $datesOfMission=Mission::find(3)->steps()
            ->with('works')
            ->get()
            ->pluck('works')
            ->collapse();

        //lay toan bo danh sach ngay co trong danh sach cong viec
        //va sau chuyen no thanh chuyen de so sanh ve sau
        $missionDayArr =array();
        for ($i = 0; $i < count($datesOfMission); $i++) {
            $date = strtotime($datesOfMission[$i]->created_at);
            $missionDayArr[$i] = date('Y-m-d', $date);
        }
        //lay toan bo danh sach note ma duoc tao tu truoc toi nay
        $notes = Note::whereDate('created_at', '<=', date('Y-m-d'))
            ->orderBy('id','desc')
            ->get();
        //
        for ($i=0; $i <count($notes) ; $i++) { 
            $date=strtotime($notes[$i]->created_at);
            $newDay=date('Y-m-d',$date);
            if (!in_array($newDay, $missionDayArr)) {
                //array_splice($notes, $i, 1);
                
            }
        }
        return $datesOfMission;
        }
    
    public function create()
    {
        
    }

    public function store(Request $request)
    {
        return $note = Note::create([
            'description' => $request->description,
            'rating' => $request->rating,
        ]);
        
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
        $note=Note::find($id);
        $note->update($request->all());
        return $note;

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
