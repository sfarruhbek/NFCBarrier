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
            <li><a class="active" href="{{route('index')}}" target="_self">
                    <i class="bi bi-house"></i>
                    Asosiy
                </a></li>
            <li><a   href="" target="_self"><i class="bi bi-clock-history"></i>
                    Tarix </a></li>
            <li><a href="" target="_self">
                    <i class="bi bi-pencil-square"></i>
                    Ma'lumotlar</a></li>
        </ul>
    </aside>
    <div id="nafisa">
        <div id="title">
            <div>
                <h1> <i class="bi bi-list"> </i>Asosiy</h1>
            </div>
            <div id="qwe">
                <div>Nafisa</div>
                <div>
                    <i class="bi bi-person bi-person-fill"></i>
                </div>
            </div>
        </div>
        <div id="view">
            <div>
                <h1>Kiruvchi mashinalar ma'lumotlari</h1>
            </div>
            <hr>
            <div id="data">
                <div>
                    <h2>Rusum</h2>
                    <h1> Tracker </h1>
                </div>
                <br>
                <div>
                    <h2>Mashina raqami</h2>
                    <h1> 90 S110NA </h1>
                </div>
                <br>
                <div>
                    <h2>Avtomobil rangi</h2>
                    <h1>
                        <canvas class="color-screen" style="background: #0a53be"></canvas>
                    </h1>
                </div>
            </div>

        </div>

        <!--        <footer>©COPYRIGHT NFC Barrier. All Right Reserved. <br>-->
        <!--            Designed by <a href="mailto:ganijanovanafisa@gmail.com">Nafisa</a>  and <a href="mailto:satimbayevfarruhbek@gmail.com">Farrukhbek</a>-->
        <!--        </footer>-->
        <footer>
            <div>© Copyright <strong>NFCBarrier</strong>. All Rights Reserved.</div>
            <div>Designed by <a href="mailto:ganijanovanafisa@gmail.com">Nafisa</a>  and <a href="mailto:satimbayevfarruhbek@gmail.com">Farrukhbek</a></div>
        </footer>
    </div>
</main>
</body>
<script src="{{asset('assets/js/script.js')}}"></script>
</html>
