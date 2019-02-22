<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prodomo;

class ProdomoController extends Controller
{
    
    public function index(){
        $listOfProdomos=Prodomo::all();
        return $listOfProdomos;
    }


    public function getProOfThisDay($day){
        $prodomos = Prodomo::whereDate('created_at', '=', $day)
            ->get();
        return $prodomos;
    }

    public function store(Request $request){
        $prodomo=new Prodomo();
        $prodomo->quantity=$request->quantity;
        $prodomo->save();
        return $prodomo;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $prodomo=Prodomo::find($id);
        $prodomo->update($request->all());
        return $prodomo;
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
