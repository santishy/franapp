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
        table {
            border-collapse: collapse;
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
        .text-justify{
            text-align: justify;
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
        .mt-0{
            margin-top: 0px;
        }
        .m-0{
            margin:0%;
        }
        .mb-0{
            margin-bottom: 0px !important;
        }
        .mb-1 {
            margin-bottom: 0.25rem;
        }
        .mb-2 {
            margin-bottom: .5rem;
        }
        .mb-4{
            margin-bottom:1rem;
        }
        .border {
            border-width: 1px;
        }
        .border-b {
            border-bottom-width: 1px;
        }
        .border-solid {
            border-style: solid;
        }
        .border-black {

        border-color: black;
        }
        .p-0{
            padding:0%;
        }
        .p-xs{
            padding:.5em;
        }
        .text-xl{
            font-size: 1.5em;
        }
        .rounded {
            border-radius: 0.25rem;
        }
        .table-auto {
            table-layout: auto;
        }
    </style>
</head>
<body>
    <div class="text-right text-sm mt-2">
        {{$now}}
    </div>
    <h1 class="text-xl text-center m-1 mb-0">{{$ticketConfig->header}}</h1>
    <div class="mb-4">
        <p class="mb-0 text-center  ">
            <span>Tel: </span> {{$ticketConfig->phone_number}}
        </p>
        <p class="mb-0 p-0 mt-0  text-center ">
            <span>Dire: </span> {{$ticketConfig->address}}
        </p>
    </div>
    <div class="text-center  text-xl rounded border border-b border-solid">
        Nota #{{$sale->id}}
    </div>
    <table class="mt-1">
        <thead>
            <tr style="border:1px solid black" class="text-center">
                <th class=" border border-b border-gray-400">Producto</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product )
                <tr class="border border-gray-400 border-solid">
                    <td class="border-b border-gray-400 border-solid">
                        {{$product->sku}}
                    </td>
                    <td>
                        {{$product->pivot->qty}}
                    </td>
                    <td>
                        {{$product->pivot->qty * $product->pivot->sale_price}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        <p class="text-justify border border-black border-solid">
            {{$ticketConfig->footer}}
        </p>
    </div>
</body>
</html>