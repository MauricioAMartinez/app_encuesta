<?php

namespace Database\Seeders;

use App\Models\pregunta;
use Illuminate\Database\Seeder;

class PreguntaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pregunta = new pregunta();
        $pregunta->pregunta_1 = 'Nombre mascota';
        $pregunta->pregunta_2 = 'Cantidad de hermanos';
        $pregunta->pregunta_3 = 'Cuantas veces come';
        $pregunta->pregunta_4 = 'Nombre padre';
        $pregunta->pregunta_5 = 'edad';
        $pregunta->save();
    }
}
