@extends('edge.layout.master')
@section('page_title', 'User List')
@section('main_content')
    <div class="content">
        <!-- /.card -->
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-xs-12 add_edit">
            <div class="card">
                <div class="card-header d-flex flex-column">
                    <h3 class="card-title">All Users</h3>
                    <div class="all-messages">
                    @include('user.layout.flash')
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="user_data_table" class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <!-- <th>S/N</th> -->
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Details</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>Action</th>
                                <!-- <th>Check</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@section('custom_scripts')

    <script type="text/javascript">
        $(function() {
            const id = $(this).data('id')
            console.log("my id is :"+id);
            var data_url = "{{ route('get.user.list') }}";
            var delete_url = "{{ route('edge.deleteUser',) }}";
            var data_column = [
                {"data": "id", visible: false},
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'details',
                    name: 'details'
                },
                 {
                    data: 'avatar_path',
                     name: 'avatar_path'
                },
                 {
                    data: 'status',
                     name: 'status',
                    orderable: false, 
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ];
            renderDataTable($('#user_data_table'), data_url, data_column);
            editOperation(editResponse, "{{ route('edge.editUser') }}");
            deleteOperation(deleteResponse, 'delete_row', delete_url);

            function editResponse(response) {};

        function deleteResponse(response) {
            if (response.success == false) {
                swalError(response.message);
            } else {
                //swalSuccess(response.message);
                renderDataTable($('#user_data_table'), data_url, data_column);
            }
        }
        });
  
    </script>

@endsection
