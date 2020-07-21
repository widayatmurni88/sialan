  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{asset('imgs/logo.png')}}"
           alt="Logo"
           class="brand-image">
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
            <a href="{{ route('dashboard')}}" class="nav-link {{ ($menu == 'dashboard') ? 'active' : ''}}">
              <i class="nav-icon fa fa-tachometer"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('lapgiatharian')}}" class="nav-link {{ ($menu == 'lapgiatharian') ? 'active' : ''}}">
              <i class="nav-icon fa fa-tasks"></i>
              <p>Lap. Kegitan Harian</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('kinerja')}}" class="nav-link">
              <i class="nav-icon fa fa-folder-open-o"></i>
              <p>Kinerja</p>
            </a>
          </li>
          <!-- Menu untuk admin-->
          <li class="nav-header">LAPORAN KNERJA (u/adm)</li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fa fa-file-text"></i>
              <p>Buat Laporan</p>
            </a>
          </li>

          <li class="nav-header">MANAJEMEN AKUN</li>
          <li class="nav-item">
            <a href="{{ route('profile')}}" class="nav-link {{ ($menu == 'profil') ? 'active' : '' }}">
              <i class="nav-icon fa fa-user-circle"></i>
              <p>Profil</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../calendar.html" class="nav-link">
              <i class="nav-icon fa fa-cogs"></i>
              <p>Akun</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('logout')}}" class="nav-link">
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