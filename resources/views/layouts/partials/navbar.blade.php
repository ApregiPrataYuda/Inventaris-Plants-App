
<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="navbar-brand navbar-brand-autodark">
    <i class="fas fa-spa" aria-hidden="true" class="navbar-brand-image text-capitalize"  aria-hidden="true"> Inventaris Plants App</i>
</div>
<hr class="my-2 border-light">


<div class="navbar-nav flex-row d-lg-none">
    
    <div class="d-none d-lg-flex">
        <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
           data-bs-placement="bottom">
    <!-- Download SVG icon from http://tabler.io/icons/icon/moon -->
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1"><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
        </a>
        <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
           data-bs-placement="bottom">
    <!-- Download SVG icon from http://tabler.io/icons/icon/sun -->
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1"><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
        </a>
        <div class="nav-item dropdown d-none d-md-flex me-3">
            <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
    <!-- Download SVG icon from http://tabler.io/icons/icon/bell -->
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1"><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                <span class="badge bg-red"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                <div class="card">
  
    
</div>
            </div>
        </div>
    </div>

    @php
    $user = dataUser();

                  $defaultImg = 'default.jpg';
                  $imageUrl = $user->image ? route('avatar.image.show', ['filename' => $user->image]) : asset('storage/avatar/' . $defaultImg);
                  $version = $user->image ? time() : time(); // Anda bisa menyesuaikan versioning untuk route
    @endphp


    <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
            <img src="{{ $imageUrl }}?v={{ $version }}" class="avatar avatar-sm rounded-circle"  style="background-image" alt="">
            <div class="d-none d-xl-block ps-2">
                <div>{{ $user->fullname }}</div>
                <div class="mt-1 small text-secondary">{{ ($user->role_id) === 1 ? 'Admin' : 'Employe' }}</div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <a href="" class="dropdown-item">Profile</a>
            <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
        </div>
    </div>
</div>
<div class="collapse navbar-collapse" id="sidebar-menu">
  

    <ul class="navbar-nav">

        @if(session()->has('role_id'))
      @php
        $role = session('role_id');
      @endphp

    @if($role == 1)
      

    <li>
        <small class="d-block px-3 nav-link-icon d-md-none d-lg-inline-block text-uppercase">Admin</small>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('Admin.Dashboard') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class="nav-icon fas fa-spa"></i>
            </span>
            <span class="nav-link-title">
                Home-Dashboard
            </span>
        </a>
    </li>

  
    <li class="nav-item">
        <a class="nav-link" href="{{ route('Admin.category.plants') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class="nav-icon fab fa-pagelines"></i>
            </span>
            <span class="nav-link-title text-capitalize">
                Master Category
            </span>
        </a>
    </li>

        <li class="nav-item">
        <a class="nav-link" href="{{ route('Admin.location.plants') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class="nav-icon fa fa-map-marker"></i>
            </span>
            <span class="nav-link-title text-capitalize">
                Master Location Plants
            </span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('Admin.plants') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class="nav-icon fa fa-seedling"></i>
            </span>
            <span class="nav-link-title text-capitalize">
                Data Plants
            </span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('Admin.log.plants') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class="nav-icon fas fa-leaf"></i>
            </span>
            <span class="nav-link-title text-capitalize">
                 Plants Log
            </span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('Admin.report.plants') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class="nav-icon fas fa-file-invoice"></i>
            </span>
            <span class="nav-link-title text-capitalize">
                 Report Plants Log
            </span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('Admin.management.users') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class="nav-icon fas fa-users"></i>
            </span>
            <span class="nav-link-title text-capitalize">
                Management User
            </span>
        </a>
    </li>



    @elseif($role == 2)
    <li>
        <small class="d-block px-3 nav-link-icon d-md-none d-lg-inline-block text-uppercase">Employe</small>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('Employe.home') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class="nav-icon fas fa-spa"></i>
            </span>
            <span class="nav-link-title">
                Home-Employe
            </span>
        </a>
    </li>
   <li class="nav-item">
        <a class="nav-link" href="{{ route('Employe.plants') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class="nav-icon fa fa-seedling"></i>
            </span>
            <span class="nav-link-title text-capitalize">
                Data Plants
            </span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('Employe.log.plants') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class="nav-icon fas fa-leaf"></i>
            </span>
            <span class="nav-link-title text-capitalize">
                 Plants Log
            </span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('Employe.report.plants') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class="nav-icon fas fa-file-invoice"></i>
            </span>
            <span class="nav-link-title text-capitalize">
                 Report Plants Log
            </span>
        </a>
    </li>
    @else

    <script>
        window.location.href = "{{ route('/') }}";
    </script>
    @endif
   @endif

    </ul>
</div>

    </div>
</aside>
      
    <header class="navbar navbar-expand-md d-none d-lg-flex d-print-none" >
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="navbar-nav flex-row order-md-last">
    <div class="d-none d-md-flex">
        <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
           data-bs-placement="bottom">
    <!-- Download SVG icon from http://tabler.io/icons/icon/moon -->
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1"><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
        </a>
        <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
           data-bs-placement="bottom">
    <!-- Download SVG icon from http://tabler.io/icons/icon/sun -->
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1"><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
        </a>
        <div class="nav-item dropdown d-none d-md-flex me-3">

    <!-- Download SVG icon from http://tabler.io/icons/icon/bell -->
   
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                <div class="card">
   
   
    </div>
            </div>
        </div>
    </div>
    <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
            <img src="{{ $imageUrl }}?v={{ $version }}" class="avatar avatar-sm rounded-circle"  style="background-image" alt="">
       {{-- <span class="avatar avatar-sm" style="background-image: ></span> --}}
            <div class="d-none d-xl-block ps-2">
                <div>{{ $user->fullname }}</div>
                <div class="mt-1 small text-secondary">{{ ($user->role_id) === 1 ? 'Admin' : 'Employe' }}</div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <a href="" class="dropdown-item">Profile</a>
            <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
        </div>
    </div>
</div>
            <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                  {{-- <small>this is if your add new title</small> --}}
                    </div>
            </div>
        </div>
    </header>