@extends('user.layout.master')
@section('main_content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">                      
                        <div class="card-body">
                            <div class="card card-primary">
                                <div class="card-header">
                                  <div class="d-flex flex-column">
                                     <h3 class="card-title">Edit Account Information</h3>
                                    <span>@include('user.layout.flash')</span>
                                  </div>
                                   
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="{{route('user.edit.account') }}" type="post" id="userCreateForm" method="post">
                                    @csrf
                                    <div class="card-body">
                                      <div class="form-group">
                                            <label for="name">Store Name</label>
                                            <input type="text" name="name" class="form-control"
                                                id="name" placeholder="Enter Store Name" value="{{auth()->user()->name}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="userEmail">Store Id</label>
                                            <input type="email" name="email" class="form-control"
                                                id="email"  @if (!empty($userData['client_transactions'][0]['id'])) disabled @endif placeholder="Enter email" value="{{auth()->user()->email}}">
                                        </div>
                                      </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                      <input type="hidden" name="id" value="{{ auth()->user()->id ?? '' }}" id="id">
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </div>
@endsection

@section('custom_scripts')
<script type="text/javascript">
  $(function () {   
    $('#userCreateForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      name: {
        required: true,
      },      
    },
    messages: {
       name: {
        required: "Please enter User Name",
        email: "Please enter a valid User Name"
      },
      email: {
        required: "Please enter a email address",
        email: "Please enter a valid email address"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

  });
  
</script>

@endsection

