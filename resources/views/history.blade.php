@extends('layouts.home')
@section('content')
    <div id="nafisa">
        <div id="title">
            <div>
                <h1> <i class="bi bi-list"> </i>Tarix</h1>
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
                    <tr>
                        <td>1</td>
                        <td>Matiz</td>
                        <td>90 N015GU </td>
                        <td>
                            <canvas class="color-screen" style="background: deeppink"></canvas>
                        </td>

                        <td> 15-iyun; 00:00</td>
                        <td>
                            <button class="btn btn-danger" onclick="deleteData(1)"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Spark</td>
                        <td>90 N016GU </td>
                        <td>
                            <canvas class="color-screen" style="background: black"></canvas>
                        </td>
                        <td> 15-iyul; 00:00</td>
                        <td>
                            <button class="btn btn-danger" onclick="deleteData(2)"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Gentra</td>
                        <td>90 N005GU </td>
                        <td>
                            <canvas class="color-screen" style="background: midnightblue"></canvas>
                        </td>
                        <td> 15-iyun; 00:00</td>
                        <td>
                            <button class="btn btn-danger" onclick="deleteData(3)"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                </table>


            </div>
            <div aria-label="Page navigation example" id="stil">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">«</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">»</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <footer>
            <div>© Copyright <strong>NFCBarrier</strong>. All Rights Reserved.</div>
            <div>Designed by <a href="mailto:ganijanovanafisa@gmail.com">Nafisa</a>  and <a href="mailto:satimbayevfarruhbek@gmail.com">Farrukhbek</a></div>
        </footer>
    </div>
    <script>
        function deleteData(id) {
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
                    Swal.fire({
                        title: "O'chirildi!",
                        text: "Muvaffaqiyatli bajarildi!",
                        icon: "success"
                    });
                }
            });
        }
    </script>

@endsection
