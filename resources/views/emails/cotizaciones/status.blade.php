<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Email</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-6">
                <img src="{{ asset('images/vclargo.jpeg') }}" alt="logo" width="100%">
            </div>
            
        </div>
        <div class="row  text-center mb-3">
            <div class="col-12">
                <h1>Hola {{ $cotizacion->usuario->name }}</h1>
            </div>
        </div>
        <div class="row  text-center">
            <div class="col-12">
                <p class="mb-2">
                    Hemos {{ $cotizacion->status == 2 ? "aceptado" : "rechazado" }} la solicitud de cotización de un {{ $cotizacion->producto->nombre }} 
                    para el la siguiente fecha: <span class="fw-bold">{{ \Carbon\Carbon::parse($cotizacion->fecha)->format('jS \o\f F, Y g:i:s a') }}</span>
                    
                </p>
                <p>
                    Si tienes alguna duda, puedes escribirnos al número 55566663
                </p>
                <blockquote class="blockquote">
                    <figcaption class="blockquote-footer">
                        Vcards
                        
                    </figcaption>
                </blockquote>
            </div>
        </div>
    </div>
    
</body>
</html>