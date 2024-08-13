@extends('layouts.home')
@section('content')
    <div id="nafisa">
        <div id="title">
            <div>
                <h1> <i class="bi bi-list"> </i>Asosiy</h1>
            </div>
            <div style="cursor: pointer" id="qwe" onclick="window.location.href=`{{route('profile.edit')}}`">
                <div>{{auth()->user()->name}}</div>
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
            <div id="data" style="display: none">
                <div>
                    <h2>Rusum</h2>
                    <h1 id="model"></h1>
                </div>
                <br>
                <div>
                    <h2>Mashina raqami</h2>
                    <h1 id="car_number"></h1>
                </div>
                <br>
                <div>
                    <h2>Avtomobil rangi</h2>
                    <h1 id="car_color">
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
        fetch('http://192.168.4.1/read');
        let dataWindow = document.getElementById('data');
        let model = document.getElementById('model');
        let car_number = document.getElementById('car_number');
        let car_color = document.getElementById('car_color');

        let default_url = `{{route('cars.show',0)}}`;
        function UpdateUrl(id) {
            return default_url.slice(0, -1) + id;
        }
        async function fetchData() {
            try {
                const response = await fetch('http://192.168.4.1/read');
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                if (data.status === 1) {
                    const updateResponse = await fetch(UpdateUrl(data.id));
                    const updateData = await updateResponse.json();

                    if (updateData !== 0) {

                        // const respOpen = await fetch('http://192.168.4.1/open');
                        // if (response.ok) {
                            dataWindow.style = "";
                            model.innerHTML = updateData.model;
                            car_number.innerHTML = updateData.car_number;
                            car_color.innerHTML = updateData.car_color;
                        // }

                        await new Promise(resolve => setTimeout(resolve, 5000));

                        //const respClose = await fetch('http://192.168.4.1/close');
                        // if (response.ok) {
                            dataWindow.style = 'display: none';
                            model.innerHTML = "";
                            car_number.innerHTML = "";
                            car_color.innerHTML = "";
                            await fetch('http://192.168.4.1/read');
                        // }
                    }
                }
            } catch (error) {
                console.error('Error:', error);
            }
            await new Promise(resolve => setTimeout(resolve, 500));
            fetchData();
        }

        fetchData();

    </script>
@endsection
