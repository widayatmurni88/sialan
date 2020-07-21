  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{asset('imgs/logo.jpg')}}"
          alt="Logo"
          class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">APP NAME</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('imgs/person.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="" class="d-block">{{ Session::get('name')}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="" class="nav-link {{ ($menu == 'dashboard') ? 'active' : ''}}">
              <i class="nav-icon fa fa-tachometer"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-header">APP SETTINGS</li>
          <li class="nav-item">
            <a href="{{ route('setPangkat')}}" class="nav-link {{ ($menu == 'pangkat') ? 'active' : ''}}">
              <i class="nav-icon fa fa-cogs"></i>
              <p>Pangkat PNS</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout')}}" class="nav-link">
              <i class="nav-icon fa fa-sign-out"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>