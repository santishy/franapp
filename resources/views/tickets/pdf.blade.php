<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket</title>
</head>
<body>
    <div>
        <header>
            {{$ticketConfig->header}}
        </header>
        <ul style="background: red;">
            @foreach ($products as $product )
                <li style="background:blue;display:flex; flex-wrap: wrap; justify-content:space-around">
                    <div>{{$product->sku}}..........</div> 
                    <div>4</div>
                </li>    
            @endforeach
            
        </ul>

    </div>
</body>
</html>