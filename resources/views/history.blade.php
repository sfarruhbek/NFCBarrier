@extends('layouts.home')
@section('content')
    <div id="nafisa">
        <div id="title">
            <div>
                <h1> <i class="bi bi-list"> </i>Tarix</h1>
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
                Kirish tarixi
            </div>
            <hr>
            <div id="data">
                <table style="width:100%; line-height: 20px" >
                    <tr>
                        <th>№</th>
                        <th>Mashina rusumi</th>
                        <th>Mashina raqami</th>
                        <th>Mashina rangi</th>
                        <th>Kirish vaqti</th>
                        <th></th>
                    </tr>
                    @foreach($history as $val)
                        <tr>
                            <td>{{$val->id}}</td>
                            <td>{{$val->car->model}}</td>
                            <td>{{$val->car->car_number}}</td>
                            <td>{{$val->car->car_color}}</td>
                            <td>{{$val->entered_date}}</td>
                            <td>
                                <button class="btn btn-danger" onclick="deleteData({{$val->id}})"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </table>


            </div>

            <div class="d-flex justify-content-center">
                {{ $history->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <footer>
            <div>© Copyright <strong>NFCBarrier</strong>. All Rights Reserved.</div>
            <div>Designed by <a href="mailto:ganijanovanafisa@gmail.com">Nafisa</a>  and <a href="mailto:satimbayevfarruhbek@gmail.com">Farrukhbek</a></div>
        </footer>
    </div>
    <script>
        function deleteData(id) {
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
                    let default_url="{{ route('data_history.destroy', 0) }}";
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
