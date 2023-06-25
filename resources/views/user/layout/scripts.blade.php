<!-- jQuery -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<!-- Bootstrap -->
<script src="{{ asset('admin_asset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('admin_asset/plugins/chart.js/Chart.min.js') }}"></script>

<script src="{{ asset('admin_asset/js/pages/dashboard3.js') }}"></script>
{{-- <script src="{{ asset('admin_asset/js/demo.js') }}"></script> --}}
<!-- DataTables  & Plugins -->
<script src="{{ asset('admin_asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="{{ asset('admin_asset/js/adminlte.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
<script src="{{ asset('js/common.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $(document).on("click", "a.dropdown-item", function() {        
            let notificationId = $(this).attr('nid');
            var url = "{{ route('user.notificationRead', ':nid') }}";
            url = url.replace(':nid', notificationId);
            $.ajax({
                url: url,
                type: "GET",
                dataType: "HTML",
                success: function(data) {
                    console.log(data);
                }
            });
        });
    });
</script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
@yield('custom_scripts')
