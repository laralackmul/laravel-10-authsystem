@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible" style="margin-top: 10px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> {{ session()->get('success') }}
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-danger alert-dismissible" style="margin-top: 10px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error!</strong> {{ session()->get('error') }}
    </div>
@elseif(session()->has('alert'))
    <div class="alert alert-danger alert-dismissible" style="margin-top: 10px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error!</strong> {{ session()->get('alert') }}
    </div>
@endif

@if (Session::has('message_for_email_verification'))
    <div class="alert alert-success" role="alert">
        <strong>Well done!</strong>
        You have successfully registered please check your registered email.
    </div>
@endif
@if (Session::has('registration_message'))
    <div class="alert alert-success" role="alert">
        <strong>Well done!</strong>
        You have successfully registered.
    </div>
@endif
@if (Session::has('registration_failed'))
    <div class="alert alert-danger" role="alert">
        <strong>Error!</strong>
        Registration Failed!Please Try Again Late.
    </div>
@endif

@if (Session::has('activeUser'))
    <div class="alert alert-success" role="alert">
        <strong>Well done!</strong>
        Your account has been successfully activated.
    </div>
@endif
@if (Session::has('activeUserNot'))
    <div class="alert alert-danger" role="alert">
        <strong>Error!</strong>
        Something is wrong.
    </div>
@endif
@if (Session::has('userNotActivated'))
    <div class="alert alert-danger" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error!</strong>
        Your account is not Varified yet.
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" style="margin-top: 10px;">
        <ul style="list-style:none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error!</strong> 
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    
@endif
