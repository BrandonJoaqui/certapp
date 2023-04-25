<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'CertApp') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body{
            font-family: 'Montserrat', sans-serif;
            background: white;
            background-image: url(https://sigmacertificamos.com/wp-content/uploads/2023/04/TRANSPARENTE.png);
            background-size: 50%;
            background-repeat: no-repeat;
            background-position: bottom left;
            background-attachment: fixed;
        }
        h4{
            font-weight:bold;
        }
    </style>
</head>
<body class="consulta-publica" >
    <nav class="header navbar navbar-expand-md navbar-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/consulta_certificados">
                <img src="/assets/odc_logo.png" class="odc-logo" >
            </a>
            <h4>Consultas en línea</h4>
        </div>
    </nav>
    <div id="main-app" >
        <div class="container" >
            @if(isset($certificado))
               @include("public.consultaCodigo")
            @elseif(isset($certificados))
                @if($tipo == "EQUIPOS")
                    @include("public.consultaEquipos")
                @endif
                @if($tipo == "PERSONAS")
                    @include("public.consultaPersonas")
                @endif
            @else

          
            <div class="card mt-2" >
                <div class="card-header" >Formulario de consulta</div>
                <div class="card-body" >
                    <consulta-certificado-form>
                        @isset($error)
                            <div class="container" >
                                <div class="alert alert-danger text-center" >{{$error}}</div>
                            </div>
                        @endisset
                    </consulta-certificado-form>
                </div>
            </div>
            @endisset
       </div>

        <footer class="py-2" >
            <div class="container">
                <div class="content-flex">
                    <img src="/assets/certapp_logo.png" alt="">
                    <div class="px-3">
                        CertApp - Software para gestión para organismos de certificación <br>
                        Development by Capyware & DOBIT development software
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>