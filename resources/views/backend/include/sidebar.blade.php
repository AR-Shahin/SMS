<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="{{ asset('uploads/backend/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('uploads/backend/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
         <a href="#" class="d-block">Dept : {{ auth()->user()->department->name ?? 'Super Admin' }}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Admin Panel -->
        @auth('web')
        {{-- <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Drop Down
                <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="../../index.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v1</p>
                </a>
            </li>

            </ul>
        </li> --}}
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="nav-icon fa fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.department.index') }}" class="nav-link">
            <i class="nav-icon fa fa-tachometer-alt"></i>
            <p>
                Department
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.session.index') }}" class="nav-link">
            <i class="nav-icon fa fa-tachometer-alt"></i>
            <p>
                Session
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.year.index') }}" class="nav-link">
            <i class="nav-icon fa fa-tachometer-alt"></i>
            <p>
                Year
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.semester.index') }}" class="nav-link">
            <i class="nav-icon fa fa-tachometer-alt"></i>
            <p>
                Semester
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.course.index') }}" class="nav-link">
            <i class="nav-icon fa fa-book"></i>
            <p>
                Course
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.d-admin.index') }}" class="nav-link">
            <i class="nav-icon fa fa-users"></i>
            <p>
                Departement Admin
            </p>
            </a>
        </li>
        <li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                @csrf
                <button class="btn btn-success btn-block text-left"> <i class="fa fa-sign-out-alt"></i> Logout</button>
            </form>
        </li>
        @endauth

        <!-- Department Admin -->

        @auth('dept_admin')
        <li class="nav-item">
            <a href="{{ route('dept-admin.dashboard') }}" class="nav-link">
            <i class="nav-icon fa fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dept-admin.course.index') }}" class="nav-link">
            <i class="nav-icon fa fa-book"></i>
            <p>
                Assign Course
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dept-admin.teacher.index') }}" class="nav-link">
            <i class="nav-icon fa fa-users"></i>
            <p>
                Teacher
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dept-admin.teacher-course') }}" class="nav-link">
            <i class="nav-icon fa fa-book"></i>
            <p>
                Assign Teacher
            </p>
            </a>
        </li>
        <li>
            <form id="logout-form" action="{{ route('dept-admin.logout') }}" method="POST" >
                @csrf
                <button class="btn btn-success btn-block text-left"> <i class="fa fa-sign-out-alt"></i> Logout</button>
            </form>
        </li>
        @endauth

        <!-- Teacher -->

        @auth('teacher')
        <li>
            <form id="logout-form" action="{{ route('teacher.logout') }}" method="POST" >
                @csrf
                <button class="btn btn-success btn-block text-left"> <i class="fa fa-sign-out-alt"></i> Logout</button>
            </form>
        </li>
        @endauth
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
