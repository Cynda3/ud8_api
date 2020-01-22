<?php

namespace App\Http\Controllers;

use App\Warship;
use Illuminate\Http\Request;

class ApiWarshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warships = Warship::all();
        return $warships;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $warship = new Warship;

        $warship->name = $request->name;
        $warship->class = $request->class;
        $warship->built = $request->built;
        $warship->length = $request->length;
        $warship->height = $request->height;
        $warship->power = $request->power;
        $warship->speed = $request->speed;

        $warship->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $warship = Warship::find($id);
        return $warship;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $warship = Warship::find($id);

        $warship->name = $request->name;
        $warship->class = $request->class;
        $warship->built = $request->built;
        $warship->length = $request->length;
        $warship->height = $request->height;
        $warship->power = $request->power;
        $warship->speed = $request->speed;

        $warship->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $warship = Warship::destroy($id);
        return $warship;
    }
}
