<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Dashboard</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{ $title }}</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">{{ $title }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <form method="GET">
                    <div class="input-group">
                      <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                      <input type="text" class="form-control" placeholder="Seacrh ..." name="search" value="{{ $search }}" />
                    </div>
                </form>
            </div>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <form action="{{ route('logout') }}" method="post"
                    onsubmit="return confirm('Apakah anda yakin ingin keluar?')">
                    <a href="{{ route('logout') }}" class="nav-link text-white font-weight-bold px-0">
                    <i class="fa-solid fa-right-from-bracket me-sm-1"></i>
                    @csrf
                    <span class="d-sm-inline d-none mr-2">Sign Out</span>
                    </form>
                    </a>
                </li>
                <li class="nav-item d-xl-none px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                    </div>
                    </a>
                </li>
                <li class="nav-item dropdown ps-xl-3 d-flex align-items-center ">
                    <a href="{{ route('pengunjung-history') }}" class="nav-link text-white p-0">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    </a>
                </li>
                <li class="nav-item dropdown ps-xl-3 d-flex align-items-center ">
                    <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                    <li class="mb-2">
                        <a class="dropdown-item" href="{{ route('pengunjung-profile.edit') }}">
                        <i class="fa fa-circle-user me-sm-1"></i>
                        <span class="d-sm-inline">Edit Profile</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a class="dropdown-item" href="{{ route('pengunjung-change-password.index') }}">
                        <i class="fa-solid fa-arrows-rotate me-sm-1"></i>
                        <span class="d-sm-inline">Change Passwod</span>
                        </a>
                    </li>
                    </ul>
                </li>
            </ul>
          </div>
    </div>
</nav>
