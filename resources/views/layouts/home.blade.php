<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shlagbaun NFC</title>
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
<body>

<nav>
    NFC Barrier
</nav>


<main>
    <aside>
        <img src="{{asset('assets/images/icon.png')}}" width="100px" alt="Eksponenta">
        <hr>
        <ul>
            <li><a class="{{ Route::is('index') ? 'active' : '' }}" href="{{route('index')}}" target="_self">
                    <i class="bi bi-house"></i>
                    Asosiy
                </a></li>
            <li><a class="{{ Route::is('history') ? 'active' : '' }}" href="{{route('history')}}" target="_self"><i class="bi bi-clock-history"></i>
                    Tarix </a></li>
            <li><a class="{{ Route::is('data') ? 'active' : '' }}" href="{{route('data')}}" target="_self">
                    <i class="bi bi-pencil-square"></i>
                    Ma'lumotlar</a></li>
        </ul>
    </aside>


    @yield('content')


</main>


</body>
<script src="{{asset('assets/js/script.js')}}"></script>
</html>
