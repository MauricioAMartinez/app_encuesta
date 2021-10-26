<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;

class EncuestasMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subjet = "Encuesta Mintic";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
        $correo = session('correo');
        $token = session('api_token');
        return $this->view('emails.envioEncuesta')->with('correo',$correo)->with('api_token',$token);
      
        
    }
}
