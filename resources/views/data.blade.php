@extends('layouts.home')
@section('content')

    <div id="nafisa">
        <div id="title">
            <div>
                <h1> <i class="bi bi-list"> </i>Ma'lumotlar</h1>
            </div>
            <div id="qwe">
                <div>Nafisa</div>
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
                                <button class="btn btn-warning" onclick="edit(1)"><i  class="bi bi-pencil"></i></button>
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
                <form id="carForm" action="{{route('cars.store')}}" method="POST">
                    @csrf
                    <label for="model">Mashina turi</label>
                    <input type="text" name="model" >
                     <label for="car_number">Mashina raqami</label>
                    <input type="text" name="car_number">
                    <label for="car_color">Mashina rangi</label>
                    <input type="text" name="car_color">
                </form> `,
                confirmButtonText:"Saqlash",
                cancelButtonText: "Bekor qilish",
                showCancelButton: true,
                showCloseButton: true,
                preConfirm: () => {
                    document.getElementById('carForm').submit();
                }
            });
        }
        function edit(id){
            console.log(id);
            let car_name="Cobalt";
            let car_number="90F777SF";
            let car_color="Qora";
            Swal.fire({

                title: "Tahrirlash",
                html: `
                <form>
                    <label for="car_name">Mashina turi</label>
                    <input type="text" name="car_name" value="${car_name}">
                     <label for="car_number">Mashina raqami</label>
                    <input type="text" name="car_number" value="${car_number}">
                    <label for="car_color">Mashina rangi</label>
                    <input type="text" name="car_color" value="${car_color}">
                </form> `,
                confirmButtonText:"Tahrirlash",
                cancelButtonText: "Bekor qilish",
                showCancelButton: true,
                showCloseButton: true
            });
        }
        function deleteData(id){
            console.log(id);
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
