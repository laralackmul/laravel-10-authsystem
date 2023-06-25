<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('edgeDashboard')}}" class="nav-link">Home</a>
        </li>        
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('edge.logout')}}" class="nav-link">Logout</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
      
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge notification-count">{{auth()->guard('admin')->user()->unreadNotifications->count()}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header tnc">{{auth()->guard('admin')->user()->unreadNotifications->count()}} Notifications</span>
                <div class="dropdown-divider"></div>
                  @foreach(auth()->guard('admin')->user()->unreadNotifications as $notification)
                  @if(!empty( $notification->data['order_id']))
                <a href="{{route("edge.reports.invoice", ["order_id" => $notification->data['order_id']])}}" nid="{{$notification->id}}" class="dropdown-item" data-toggle="tooltip" title="BDT-{{$notification->data['order_amount']?? 00 }} debited from {{$notification->data['payment_issuer']?? 'TravelZoo' }} on {{$notification->created_at}}  ( {{calculateDateDifference(strtotime($notification->created_at), strtotime(date('Y-m-d H:i:s')));}} ago)">
                    <i class="fas fa-coins"></i>BDT-{{$notification->data['order_amount']?? 00 }} debited from {{$notification->data['payment_issuer']?? 'TravelZoo' }}
                    <i class="fa fa-close " title="Marked As Read"></i>
                    {{-- <span class="float-right text-muted text-sm">{{$notification->created_at ?? date('Y-m-d H:is') }}</span> --}}
                </a>
                @endif
                @if(!empty( $notification->data['customer_email']))
                <a href="{{route('edge.userProfile',$notification->data['customer_email'])}}" nid="{{$notification->id}}" class="dropdown-item" data-toggle="tooltip" title="New User - {{$notification->data['customer_name'] }} registered on {{$notification->created_at}}  ( {{calculateDateDifference(strtotime($notification->created_at), strtotime(date('Y-m-d H:i:s')));}} ago)">
                    <i class="fas fa-user"></i>New User - {{$notification->data['customer_name'] }}
                    <i class="fa fa-close " title="Marked As Read"></i>
                    {{-- <span class="float-right text-muted text-sm">{{$notification->created_at ?? date('Y-m-d H:is') }}</span> --}}
                </a>
                @endif
               
                <div class="dropdown-divider"></div>
                @endforeach
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> --}}
    </ul>
</nav>
