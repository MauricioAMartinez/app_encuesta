<?php

namespace App\Http\Controllers;


use App\Models\correo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\EncuestasMailable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;


class CorreoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $correo = correo::all();

        return $correo;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $correo = new Correo();
        $correo->correo = $request->correo;
        $correo->api_token = Str::random(20);
        $correo->save();

        session()->flash('correo',  $correo->correo);
        session()->flash('api_token',  $correo->api_token);

        $plantilla = new EncuestasMailable;
        Mail::to($request->correo)->send($plantilla);
        return 'Mensaje Enviado';
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $correo = Correo::find($request->id);
        $correo->correo = $request->correo;
        $correo->api_token = Str::random(20);
        $correo->save();

        session()->flash('correo',  $correo->correo);
        session()->flash('api_token',  $correo->api_token);
       

        $plantilla = new EncuestasMailable;
        Mail::to($request->correo)->send($plantilla);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Correo $correo)
    {
        $correo->delete();
    }
}
