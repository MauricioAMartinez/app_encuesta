<?php

namespace Database\Seeders;

use App\Models\respuesta;
use Illuminate\Database\Seeder;

class RespuestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $respuesta = new respuesta();
        $respuesta->respuesta_1 = 'Bruce';
        $respuesta->respuesta_2 = '0';
        $respuesta->respuesta_3 = '5';
        $respuesta->respuesta_4 = 'HJJFKDSFHJ';
        $respuesta->respuesta_5 = '25';
        $respuesta->preguntas_id = '1';
        $respuesta->correos_id = '1';
        $respuesta->save();
    }
}
