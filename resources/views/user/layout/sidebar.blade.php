  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('userDashboard') }}" class="brand-link">
          <img src="{{asset('admin_asset/img/laravel.png')}}" alt="Laravel-10-AauthSystem"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Laravel-10</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">

              {{-- <div class="image">
                  <img src="{{ asset('admin_asset/img/user1.jpg') }}" class="img-circle elevation-2" alt="User Image">
              </div> --}}
              <div class="info">
                  <a href="#" class="d-block">{{ ucwords(auth()->user()->name) }}</a>
                  <p style="margin:0;padding:0;color:#D0D4DB"><small>{{ auth()->user()->email }}</small></P>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">                 

                  <li class="nav-header">Manage Account</li>
                  <li class="nav-item">
                      <a href="{{ route('userAccount') }}" class="nav-link">
                          <i class="nav-icon fas fa-user"></i>
                          <p>My Account </p>
                      </a>
                  </li>
                  {{-- <li class="nav-item">
                      <a href="{{ route('userDashboard') }}" class="nav-link">
                          <i class="nav-icon fas fa-user"></i>
                          <p>Edit Profile</p>
                      </a>
                  </li> --}}
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
