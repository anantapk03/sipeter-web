<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset("layout_asset/examples/assets/img/logo_1.png")}}" type="image/x-icon"/>
    <title>Login - Sipeter</title>
    <style>
        /* Importing fonts from Google */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        /* Reseting */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #ecf0f3;
        }

        .wrapper {
            max-width: 350px;
            min-height: 500px;
            margin: 80px auto;
            padding: 40px 30px 30px 30px;
            background-color: #ecf0f3;
            border-radius: 15px;
            box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
        }

        .logo {
            width: 80px;
            margin: auto;
        }

        .logo img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0px 0px 3px #5f5f5f,
                0px 0px 0px 5px #ecf0f3,
                8px 8px 15px #a7aaa7,
                -8px -8px 15px #fff;
        }

        .wrapper .name {
            font-weight: 600;
            font-size: 1.4rem;
            letter-spacing: 1.3px;
            padding-left: 10px;
            color: #555;
        }

        .wrapper .form-field input {
            width: 100%;
            display: block;
            border: none;
            outline: none;
            background: none;
            font-size: 1.2rem;
            color: #666;
            padding: 10px 15px 10px 10px;
            /* border: 1px solid red; */
        }

        .wrapper .form-field {
            padding-left: 10px;
            margin-bottom: 20px;
            border-radius: 20px;
            box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
        }

        .wrapper .form-field .fas {
            color: #555;
        }

        .wrapper .btn {
            box-shadow: none;
            width: 100%;
            height: 40px;
            background-color: #0F59B9;
            color: #fff;
            border-radius: 25px;
            box-shadow: 3px 3px 3px #b1b1b1,
                -3px -3px 3px #fff;
            letter-spacing: 1.3px;
        }

        .wrapper .btn:hover {
            background-color: #039BE5;
        }

        .wrapper a {
            text-decoration: none;
            font-size: 0.8rem;
            color: #03A9F4;
        }

        .wrapper a:hover {
            color: #039BE5;
        }

        @media(max-width: 380px) {
            .wrapper {
                margin: 30px 20px;
                padding: 40px 15px 15px 15px;
            }
        }
    </style>

</head>
<body>
    <div class="wrapper">
        <div class="logo">
            <img src="{{asset('layout_asset\examples\assets\img\logo_login.png')}}" alt="">
        </div>
        <div class="text-center mt-4 name">
            Sipeter
        </div>
        <form class="p-3 mt-3" method="POST" action="{{route('loginPost')}}" >
            @csrf
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="username" id="userName" placeholder="Username" required>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password" required>
            </div>
            <button class="btn mt-3">Masuk</button>
        </form>
        <center>
            <div class="text-center fs-6 mt-3">
                <a href="#">Forget password?</a>
            </div>
        </center>
    </div>

 <!--   Core JS Files   -->
<script src="{{asset("layout_asset/examples/assets/js/core/jquery.3.2.1.min.js")}}"></script>
<script src="{{asset("layout_asset/examples/assets/js/core/popper.min.js")}}"></script>
<script src="{{asset("layout_asset/examples/assets/js/core/bootstrap.min.js")}}"></script>
<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
{{-- <script src="{{asset("layout_asset/examples/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js")}}"></script> --}}
<script src="{{asset("layout_asset/examples/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js")}}"></script>
<!-- jQuery Scrollbar -->
<script src="{{asset("layout_asset/examples/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js")}}"></script>
<!-- Chart JS -->
<script src="{{asset("layout_asset/examples/assets/js/plugin/chart.js/chart.min.js")}}"></script>
<!-- jQuery Sparkline -->
<script src="{{asset("layout_asset/examples/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js")}}"></script>
<!-- Chart Circle -->
<script src="{{asset("layout_asset/examples/assets/js/plugin/chart-circle/circles.min.js")}}"></script>
<!-- Datatables -->
<script src="{{asset("layout_asset/examples/assets/js/plugin/datatables/datatables.min.js")}}"></script>
<!-- Bootstrap Notify -->
<script src="{{asset("layout_asset/examples/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js")}}"></script>
<!-- jQuery Vector Maps -->
<script src="{{asset("layout_asset/examples/assets/js/plugin/jqvmap/jquery.vmap.min.js")}}"></script>
<script src="{{asset("layout_asset/examples/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js")}}"></script>
<!-- Sweet Alert -->
<script src="{{asset("layout_asset/examples/assets/js/plugin/sweetalert/sweetalert.min.js")}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Atlantis JS -->
<script src="{{asset("layout_asset/examples/assets/js/atlantis.min.js")}}"></script>

{{-- Table Responsives --}}
<script >
    $(document).ready(function() {
        $('#basic-datatables').DataTable({
            order:[],
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] // Menyediakan pilihan untuk jumlah baris per halaman
        });

        $('#multi-filter-select').DataTable( {
            "pageLength": 5,
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                            );

                        column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                    } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        });

        // Add Row
        $('#add-row').DataTable({
            "pageLength": 5,
        });

        var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $('#addRowButton').click(function() {
            $('#add-row').dataTable().fnAddData([
                $("#addName").val(),
                $("#addPosition").val(),
                $("#addOffice").val(),
                action
                ]);
            $('#addRowModal').modal('hide');

        });
    });
</script>
<script >
    $(document).ready(function() {
        $('#basic-datatables1').DataTable({
            order:[],
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] // Menyediakan pilihan untuk jumlah baris per halaman
        });

        $('#multi-filter-select').DataTable( {
            "pageLength": 5,
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                            );

                        column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                    } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        });

        // Add Row
        $('#add-row').DataTable({
            "pageLength": 5,
        });

        var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $('#addRowButton').click(function() {
            $('#add-row').dataTable().fnAddData([
                $("#addName").val(),
                $("#addPosition").val(),
                $("#addOffice").val(),
                action
                ]);
            $('#addRowModal').modal('hide');

        });
    });
</script>
    {{-- SWAL MESSEGE --}}
    <div id="sessionMessegeResponse">
        @if (session("success"))
        <script>
            swal("Berhasil", "{{session('success')}}", {
                icon : "success",
                buttons: {
                    confirm: {
                        className : 'btn btn-success'
                    }
                },
            });
        </script>
        @endif

        @if (session('error'))
            <script>
                swal("Gagal!", "{{session('error')}}", {
                    icon : "error",
                    buttons: {
                        confirm: {
                            className : 'btn btn-danger'
                        }
                    },
                });
            </script>
        @endif
    </div>
</body>
</html>