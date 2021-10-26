<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
        <link href="{{asset('css/app.css')}}" rel="stylesheet"> 
    </head>
    <body>
        <div class="col-md-12" >
            
            <div id="app" class="content">

                <v-app>
                    <encuestaok-component></encuestaok-component>
                </v-app>
                
            </div>
        </div>
        <script src="{{asset('js/app.js')}}"></script> 
    </body>
</html>