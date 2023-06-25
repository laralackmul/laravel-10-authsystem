@extends('edge.layout.master')
@section('page_title', 'User Profile')
@section('main_content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h2 class="card-title">User Profile</h2>
                                <div class="button-holder">
                                    <button class="btn btn-default btn-outline-info btn-sm " id="userList"
                                        onclick="window.location='{{ route('edge.user.list.view') }}'"><i
                                            class="fa fa-list" aria-hidden="true"></i>
                                        User List
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-md">Name</span>
                                    <span class="text-bold text-md">
                                        Email
                                        </span>
                                        <span class="text-bold text-md">
                                        Public Link
                                        </span>
                                        <span class="text-bold text-md">
                                        Details
                                        </span>
                                        <span class="text-bold text-md">
                                        Avatar
                                        </span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success text-md">
                                        {{$data['name']}}
                                    </span>
                                    <span class="text-success text-md">{{$data['email']}}</span>
                                     <span class="text-success text-md">{{$data['public_link']}}</span>
                                    <span class="text-success text-md">{{$data['details']}}</span>
                                    
                                     <span class="text-success text-md"><img src="{{asset('file_root').'/'.$data['avatar_path']}}" alt="User Profile Image" height="100"></span>
                                </p>
                            </div>       
                        </div>
                    </div>
                    <!-- /.card -->

                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-6">

                    <!-- /.card -->

                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
