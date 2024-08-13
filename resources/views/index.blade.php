@extends('layouts.home')
@section('content')
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

        <footer>
            <div>© Copyright <strong>NFCBarrier</strong>. All Rights Reserved.</div>
            <div>Designed by <a href="mailto:ganijanovanafisa@gmail.com">Nafisa</a>  and <a href="mailto:satimbayevfarruhbek@gmail.com">Farrukhbek</a></div>
        </footer>
    </div>
    <script>
        function fetchData() {
            fetch('http://192.168.4.1/read')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => console.log(data))
                .catch(error => console.error('Error:', error));
        }

        setInterval(fetchData, 1000);


    </script>
@endsection
