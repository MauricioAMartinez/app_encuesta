<?php

namespace App\Http\Controllers;

use App\Models\correo;
use App\Models\respuesta;

use Illuminate\Http\Request;

class RespuestaController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $consulta = Correo::select('id')->where("correo", "=", $request->correo)->get();
        $consulta = $consulta[0]->id;


        $respuesta = new respuesta();
        $respuesta->respuesta_1 = $request->respueta_1;
        $respuesta->respuesta_2 = $request->respueta_2;
        $respuesta->respuesta_3 = $request->respueta_3;
        $respuesta->respuesta_4 = $request->respueta_4;
        $respuesta->respuesta_5 = $request->respueta_5;
        $respuesta->preguntas_id = 1;
        $respuesta->correos_id = $consulta;

        $respuesta->save();

        /*
        $correo = Correo::table('respuestas')
        ->where('id', $consulta)
        ->update(['api_toke' => 0]);
        */
        $consulta;
        $correo = Correo::find($consulta);
        $correo->api_token = 0;
        $correo->created_at = $correo->created_at;
        $correo->updated_at = $correo->updated_at;
        $correo->correo = $correo->correo;
       
        $correo->save();
        return $correo;
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $respuesta = respuesta::where("correos_id", "=", $id)->get();
   

        return $respuesta;
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
    public function update(Request $request)
    {
        //

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
