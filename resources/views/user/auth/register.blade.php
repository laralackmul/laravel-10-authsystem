@extends('user.auth.layout.master')
@if(!empty($customerProfile) && sizeof($customerProfile)>0)
@section('ogMeta')
<meta property="og:title" content="{{$customerProfile['name']}}" />
    <meta property="og:type" content="{{$customerProfile['email']}}" />
    <meta property="og:description" content="{{$customerProfile['details']}}" />
    <meta property="og:url" content="{{$customerProfile['public_link']}}" />
    <meta
      property="og:image"
      content="{{asset($customerProfile['avatar_path'])}}"
    />
@endsection
@endif
@section('auth_content')

    <body class="hold-transition register-page">
        <div class="register-box">   
            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg">Register in {{ env('APP_NAME') }}</p>

                    @include('user.layout.flash')

                    <form action="{{ route('user.register') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Full name" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="details" class="form-control" placeholder="Customer Details" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" id="avatar" name="avatar" required class="dropify"
                                data-allowed-file-extensions="jpg png jpeg gif svg" data-max-file-size="1M"
                                data-default-file="">
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Confirm password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @if(config('services.recaptcha.key'))
                            <div class="mb-3 g-recaptcha"
                                data-sitekey="{{config('services.recaptcha.key')}}">
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                    <label for="agreeTerms">
                                        I have read and accept the <a href="https://github.com/laralackmul/laravel-10-authsystem/blob/main/readme.md"
                                            target="_blank">terms</a>
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>                  

                    <a href="{{ route('user.showLoginForm') }}" class="text-center">I already have a membership</a>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
    @endsection
