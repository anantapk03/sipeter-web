<!--   Core JS Files   -->
<script src="{{asset("layout_asset/examples/assets/js/core/jquery.3.2.1.min.js")}}"></script>
<script src="{{asset("layout_asset/examples/assets/js/core/popper.min.js")}}"></script>
<script src="{{asset("layout_asset/examples/assets/js/core/bootstrap.min.js")}}"></script>
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evSX huddled7lwJEjsozEaTshmvzwESaNIlw4n9zXPDXKfjunfBuT8NgJoRi+B8t" crossorigin="anonymous"> --}}
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