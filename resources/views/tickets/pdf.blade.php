<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota #{{$sale->id}}</title>
    <style>
        html, body {
            margin:0%;
            margin-right: 4pt;
            margin-left: 4pt;
        }
        .text-center {
            text-align: center;
        }
        .text-xl{
            font-size: 18px;
        }
        .text-left{
            text-align: left;
        }
        .text-right{
            text-align: right;
        }
        .text-sm{
            font-size: 0.7em;
        }
        .text-xs{
            font-size: 0.5em;
        }
        .mt-2{
            margin-top: 2em;
        }
        .mt-1{
            margin-top: 1em;
        }
        .m-0{
            margin:0%;
        }
    </style>
</head>
<body>
    <div class="text-right text-sm mt-2">
        {{$now}}
    </div>
    <h1 class="text-xl text-center m-1">{{$ticketConfig->header}}</h1>
    <div class="text-center">
        Nota #{{$sale->id}}
    </div>
    <table class="mt-1">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</body>
</html>