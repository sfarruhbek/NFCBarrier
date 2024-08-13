@extends('layouts.home')
@section('content')

    <div id="nafisa">
        <div id="title">
            <div>
                <h1> <i class="bi bi-list"> </i>Ma'lumotlar</h1>
            </div>
            <div style="cursor: pointer" id="qwe" onclick="window.location.href=`{{route('profile.edit')}}`">
                <div>{{auth()->user()->name}}</div>
                <div>
                    <i class="bi bi-person bi-person-fill"></i>
                </div>
            </div>
        </div>
        <div id="view_history">
            <div>
                Ma'lumotlar
            </div>
            <hr>
            <div class="text-end">
                <button class="btn btn-primary button" onclick="add()">
                    <i class="bi bi-plus-lg"></i>
                </button>
            </div>
            @if(session('success'))
                <div id="success-alert" class="alert alert-success alert-dismissible" role="alert">
                    <strong>Muvaffaqiyat!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopmoq"></button>
                </div>
            @endif
            <div id="data">
                <table style="width:100%; line-height: 20px" >
                    <tr>
                        <th>№</th>
                        <th>Mashina rusumi</th>
                        <th>Mashina raqami</th>
                        <th>Mashina rangi</th>
                        <th> </th>
                    </tr>
                    @foreach($cars as $car)
                        <tr>
                            <td>{{$car->id}}</td>
                            <td>{{$car->model}}</td>
                            <td>{{$car->car_number}}</td>
                            <td>{{$car->car_color}}</td>
                            <td class="pointer-cursor">
                                <button class="btn btn-warning" onclick="edit(`{{$car->id}}`,`{{$car->model}}`,`{{$car->car_number}}`,`{{$car->car_color}}`)"><i  class="bi bi-pencil"></i></button>
                                <button class="btn btn-danger" onclick="deleteData({{$car->id}})"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </table>

            </div>
            <div class="d-flex justify-content-center">
                {{ $cars->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <footer>
            <div>© Copyright <strong>NFCBarrier</strong>. All Rights Reserved.</div>
            <div>Designed by <a href="mailto:ganijanovanafisa@gmail.com">Nafisa</a>  and <a href="mailto:satimbayevfarruhbek@gmail.com">Farrukhbek</a></div>
        </footer>
    </div>
    <script>
        function add(){
            Swal.fire({
                title: "Qo'shish",
                html: `
                <form id="carForm" method="POST">
                    @csrf
                    <label for="model">Mashina turi</label>
                    <input id="SWModel" type="text" name="model" required>
                    <label for="car_number">Mashina raqami</label>
                    <input id="SWCar_number" type="text" name="car_number" required>
                    <label for="car_color">Mashina rangi</label>
                    <input id="SWCar_color" type="text" name="car_color" required>
                </form> `,
                confirmButtonText: "NFC Card qo'shish",
                cancelButtonText: "Bekor qilish",
                showCancelButton: true,
                showCloseButton: true,
                showLoaderOnConfirm: true,
                preConfirm: async () => {
                    let model = document.getElementById('SWModel');
                    let car_number = document.getElementById('SWCar_number');
                    let car_color = document.getElementById('SWCar_color');

                    if(model.value === "" || car_number.value === "" || car_color.value === ""){
                        if(model.value === "") {
                            model.style = "border: 1px solid red";
                        }else{
                            model.style = "";
                        }
                        if(car_number.value === "") {
                            car_number.style = "border: 1px solid red";
                        }else{
                            car_number.style = "";
                        }
                        if(car_color.value === "") {
                            car_color.style = "border: 1px solid red";
                        }else{
                            car_color.style = "";
                        }
                        Swal.showValidationMessage(`
                            To'ldirilishi kerak bo'lgan maydonlarni to'ldiring
                        `);
                    } else {

                        let ss = true;
                        await fetch('{{ route('car.check') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for Laravel
                            },
                            body: JSON.stringify({
                                model: model.value,
                                car_number: car_number.value,
                                car_color: car_color.value,
                            })
                        }).then(response => {
                            if (!response.ok) {
                                Swal.showValidationMessage(`
                                    Bunday nomerli foydalanuvchi mavjud
                                `);
                                ss = false;
                            }
                        });

                        if (ss) {
                            const url = `http://192.168.4.1/read`;
                            fetch(url);
                            try {
                                let response;
                                let result;
                                while (true) {
                                    response = await fetch(url);
                                    result = await response.json();
                                    if (result.status === 1) {

                                        await fetch('{{ route('car.check.card') }}', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({
                                                card: result.id,
                                            })
                                        }).then(response => {
                                            if (!response.ok) {
                                                Swal.showValidationMessage(`
                                                    Bunday id li card mavjud
                                                `);
                                            }
                                        });
                                        break;
                                    }
                                    await new Promise(resolve => setTimeout(resolve, 200));
                                }
                                return result;
                            } catch (error) {
                                Swal.showValidationMessage(`
                                    Error: NFC Reader topilmadi
                                `);
                            }
                        }
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                let model = document.getElementById('SWModel').value;
                let car_number = document.getElementById('SWCar_number').value;
                let car_color = document.getElementById('SWCar_color').value;
                if (result.isConfirmed) {
                    const resultData = result.value;

                    Swal.fire({
                        title: `Yangi karta`,
                        text: `ID: ${resultData.id}`,
                        icon: 'info',
                        showConfirmButton: true,
                        showCancelButton: true,
                        confirmButtonText: "Saqlash",
                    }).then((result) => {
                        if (result.isConfirmed){
                            fetch('{{ route('cars.store') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for Laravel
                                },
                                body: JSON.stringify({
                                    model: model,
                                    car_number: car_number,
                                    car_color: car_color,
                                    card: resultData.id,
                                })
                            })
                                .then(response => {
                                    if (response.ok) {
                                        Swal.fire({
                                            title: "Saqlandi!",
                                            text: "Muvaffaqiyatli bajarildi!",
                                            icon: "success"
                                        }).then(() => {
                                            window.location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            title: "Xato",
                                            text: "Xatolik yuz berdi!",
                                            icon: "error"
                                        });
                                    }
                                });
                        }
                    });
                }
            });
        }

        function edit(id,model,car_number,car_color){
            let default_url="{{ route('cars.update', 0) }}";
            default_url = default_url.slice(0, -1) + id;

            Swal.fire({

                title: "Tahrirlash",
                html: `
                <form id="updateCarForm" action="${default_url}" method="POST">
                    @method("PUT")
                    @csrf
                    <label for="model">Mashina turi</label>
                    <input type="text" name="model" value="${model}" required>
                     <label for="car_number">Mashina raqami</label>
                    <input type="text" name="car_number" value="${car_number}" required>
                    <label for="car_color">Mashina rangi</label>
                    <input type="text" name="car_color" value="${car_color}" required>
                </form> `,
                confirmButtonText:"Tahrirlash",
                showDenyButton: true,
                denyButtonText: `NFC kartani yangilash`,
                denyButtonColor: 'green',
                cancelButtonText: "Bekor qilish",
                showCancelButton: true,
                showCloseButton: true,
                preConfirm: () => {
                    document.getElementById('updateCarForm').submit();
                }
            }).then(result =>{
                if(result.isDenied){
                    Swal.fire({
                        title: "Kartani o'zgartirish",
                        showConfirmButton: true,
                        confirmButtonText: "Kartani qidirish",
                        showCancelButton: true,
                        showLoaderOnConfirm: true,
                        preConfirm: async () => {
                            const url = `http://192.168.4.1/read`;
                            fetch(url);
                            try {
                                let response;
                                let result;
                                while (true) {
                                    response = await fetch(url);
                                    result = await response.json();
                                    if (result.status === 1) {

                                        await fetch('{{ route('car.check.card') }}', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({
                                                card: result.id,
                                            })
                                        }).then(response => {
                                            if (!response.ok) {
                                                Swal.showValidationMessage(`
                                                    Bunday id li card mavjud
                                                `);
                                            }
                                        });
                                        break;
                                    }
                                    await new Promise(resolve => setTimeout(resolve, 200));
                                }
                                return result;
                            } catch (error) {
                                Swal.showValidationMessage(`
                                    Error: NFC Reader topilmadi
                                `);
                            }
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then(result=>{
                       if(result.isConfirmed){
                           const resultData = result.value;
                           Swal.fire({
                               title: `Yangi karta`,
                               text: `ID: ${resultData.id}`,
                               icon: 'info',
                               showConfirmButton: true,
                               showCancelButton: true,
                               confirmButtonText: "O'zgartirish",
                           }).then(r=>{
                               if(r.isConfirmed){
                                   fetch('{{ route('car.update.card') }}', {
                                       method: 'POST',
                                       headers: {
                                           'Content-Type': 'application/json',
                                           'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for Laravel
                                       },
                                       body: JSON.stringify({
                                           id: id,
                                           card: resultData.id,
                                       })
                                   })
                                       .then(response => {
                                           if (response.ok) {
                                               Swal.fire({
                                                   title: "Saqlandi!",
                                                   text: "Muvaffaqiyatli bajarildi!",
                                                   icon: "success"
                                               }).then(() => {
                                                   window.location.reload();
                                               });
                                           } else {
                                               Swal.fire({
                                                   title: "Xato",
                                                   text: "Xatolik yuz berdi!",
                                                   icon: "error"
                                               });
                                           }
                                       });
                               }
                           })
                       }
                    });
                }
            });
        }
        function deleteData(id){
            Swal.fire({
                title: "Ishonchingiz komilmi?",
                text: "Siz buni qayta tiklay olmaysiz",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ha. o'chiraman"
            }).then((result) => {
                if (result.isConfirmed) {
                    let default_url="{{ route('cars.destroy', 0) }}";
                    default_url = default_url.slice(0, -1) + id;
                    fetch(default_url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    }).then(response => {
                        if (response.ok) {
                            Swal.fire({
                                title: "O'chirildi!",
                                text: "Muvaffaqiyatli bajarildi!",
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: "Xato",
                                text: "O'chirishda xatolik yuz berdi!",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection
