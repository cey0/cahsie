<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>
<body>
    <div class="containe">
        <div class="sidebar">
            <h1>Menu</h1>
            <ul>
                <li><a class="nav-links" href="{{route('barang.index')}}">CRUD barang</a></li>
                <li><a class="nav-links" href="{{route('user.index')}}">CRUD user</a></li>
                <li><a class="nav-links" href="#">laporan</a></li>
                
            </ul>
        </div>
        @yield('content')
    </div>
</body>
</html>