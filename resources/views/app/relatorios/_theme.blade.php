<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teo Gym</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        body {
            font-size: 10px;
        }
        img {
            width: 50px;
        }
        main {
            margin-top: 40px;
        }
        header {
            background-color: #f4f8fb;
            padding: 15px;
        }
    </style>    
</head>
<body>
    <header>
        <div class="row">
            <div class="col-md-3">
                <img class="img-fluid float-left" src="{{ public_path('img/logo.png') }}">
            </div>

            <div class="col-md-6">
                <h5 class="text-center">Teogym - Academia</h4>
                <h6 class="text-center">@yield('title')</h5>
            </div>
            
            <div class="col-md-3">
                <img class="img-fluid float-right" src="{{ public_path('img/logo.png') }}">
            </div>
        </div>    
    </header>  
    <main>
        @yield('content')
    </main>    
</body>
</html>    