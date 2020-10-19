<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Franapp</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    
   
</head>
<body class="bg-gray-200">
    <div id="app">
    <nav-component></nav-component>
        @yield('content')
        
    </div>
 
    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://kit.fontawesome.com/d76bff94d9.js" crossorigin="anonymous"></script>
   
</body>
</html>