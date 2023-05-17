<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title")</title>
    
    <link href="{{ url('css/app.css') }}?dt={{filemtime(base_path('public/css/app.css'))}}" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;600;700;900&display=swap');
        
        .h1{
            font-weight:700;
            font-size:28pt;
        }

        .h2{
            font-weight:700;
            font-size:24pt;
        }
        
        .h3{
            font-size:20pt;
            font-weight:600;
        }

        .bold-700{
            font-weight:700;
        }

        .bold-600{
            font-weight:600;
        }

        .bold-900{
            font-weight:900;
        }

        .font-small{
            font-size:12pt
        }

        .text-mayus{
            text-transform:uppercase;
        }

        body{
            position:relative;
            width:1410px;
            height:1089px;
            text-align:center;
            font-size:15pt;
            background-color: red !important;
            font-family: "Montserrat", sans-serif;
        }    

        .page-container{
            display: inline-block;
            position: relative;
            width: 100%;
            height: 100%;
            
            background-color: white;
            overflow:hidden;
            padding: 30px 90px ;
            
            background-image: url('https://sigmacertificamos.com/wp-content/uploads/2023/04/TRANSPARENTE.png');
            background-size: 80%;
            background-repeat: no-repeat;
            background-position: bottom left;
            
        }

        .odc_logo{
            width: 170px;
        }


        .tablas-firmas{
            width:100%;
        }

        .tablas-firmas td{
            border:none;
        }

        .contenedores-firma-img{
            vertical-align:bottom;
        }

        .contenedores-firma hr{
            margin-top:0;
            padding-top:0;
        }

        .contenedores-firma{
            width: 40%
        }

        .contenedores-firma img{
            width:55%
        }

        .footer{
            position: absolute;
            bottom:0;
            width:100%;
            left:0;
            background-color:#325eae;
            color:white;
            margin:0;
        }

        .bottom-line{
            position: absolute;
            bottom:0;
            width:100%;
            height:60px;
        }
        

        table td{
            padding:2pt;
            text-align:center;
            border:0.5pt solid #dee2e6;
        }
    </style>
    
</head>
<body>
    <div class="page-container">
        @yield("content")
    </div>
</body>
</html>