<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('userDashboard')}}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('user.logout')}}" class="nav-link">Logout</a>
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
                <span class="badge badge-warning navbar-badge notification-count">{{auth()->user()->unreadNotifications->count()}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header tnc">{{auth()->user()->unreadNotifications->count()}} Notifications</span>
                <div class="dropdown-divider"></div>
                  @foreach(auth()->user()->unreadNotifications as $notification)
                <a href="{{route("user.reports.invoice", ["order_id" => $notification->data['order_id']])}}" nid="{{$notification->id}}" class="dropdown-item" data-toggle="tooltip" title="BDT-{{$notification->data['order_amount']?? 00 }} debited from {{$notification->data['payment_issuer']?? 'TravelZoo' }} on {{$notification->created_at}}  ( {{calculateDateDifference(strtotime($notification->created_at), strtotime(date('Y-m-d H:i:s')));}} ago)">
                    <i class="fas fa-coins"></i>BDT-{{$notification->data['order_amount']?? 00 }} debited from {{$notification->data['payment_issuer']?? 'TravelZoo' }}
                    <i class="fa fa-close " title="Marked As Read"></i>
                    {{-- <span class="float-right text-muted text-sm">{{$notification->created_at ?? date('Y-m-d H:is') }}</span> --}}
                </a>
               
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
