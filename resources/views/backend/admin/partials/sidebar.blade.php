<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 ps ps--active-y" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#">
        <img src="{{ asset('Backend/assets/img/logo-perpus.png') }}" class="navbar-brand-img h-100" alt="main_logo" />
        <span class="ms-1 font-weight-bold">Admin Dashboard</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0" />
    <div class="collapse navbar-collapse w-auto h-auto ps" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link  {{ request()->routeIs('admin-dashboard.*') ? 'active' : 'collapsed' }}"  aria-current="page" href="{{ route('admin-dashboard.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin-daftar-buku.*') ? 'active' : 'collapsed' }} " aria-current="page" href="{{ route('admin-daftar-buku.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-book-bookmark text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Daftar Buku</span>
          </a>
        </li>
        <li class="nav-item">
            <a data-bs-toggle="collapse" href="#pagesExamples" class="nav-link {{ request()->routeIs('admin-history-pengunjung.*') ? 'active' : 'collapsed' }}" aria-controls="pagesExamples" role="button" aria-expanded="false">
              <div class="icon icon-shape icon-sm text-center d-flex align-items-center me-2 justify-content-center">
                <i class="fa-solid fa-clock-rotate-left text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">History</span>
            </a>
            <div class="collapse  {{ request()->routeIs('admin-history-pengunjung.*') ? 'show' : 'collapsed' }}" id="pagesExamples">
              <ul class="nav ms-4">
                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin-history-pengunjung.*') ? 'active' : 'collapsed' }} " aria-current="page" href="{{ route('admin-history-pengunjung.index') }}">
                    <span class="sidenav-normal">History Pengunjung</span></span>
                  </a>
                </li>
              </ul>
            </div>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#pagesExamples" class="nav-link {{ request()->routeIs('admin-kategori-buku.*') || request()->routeIs('admin-kelas.*') || request()->routeIs('admin-jurusan.*')  ? 'active' : 'collapsed' }}" aria-controls="pagesExamples" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center me-2 justify-content-center">
              <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Kategori</span>
          </a>
          <div class="collapse  {{ request()->routeIs('admin-kategori-buku.*') || request()->routeIs('admin-kelas.*') || request()->routeIs('admin-jurusan.*')  ? 'show' : 'collapsed' }}" id="pagesExamples">
            <ul class="nav ms-4">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin-kategori-buku.*') ? 'active' : 'collapsed' }} " aria-current="page" href="{{ route('admin-kategori-buku.index') }}">
                  <span class="sidenav-normal">Kategori Buku</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin-kelas.*') ? 'active' : 'collapsed' }} " aria-current="page" href="{{ route('admin-kelas.index') }}">
                  <span class="sidenav-normal">Kelas</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin-jurusan.*') ? 'active' : 'collapsed' }} " aria-current="page" href="{{ route('admin-jurusan.index') }}">
                  <span class="sidenav-normal">Jurusan</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Dashboard Web</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin-new-book.*') ? 'active' : 'collapsed' }} " aria-current="page" href="{{ route('admin-new-book.admin') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-check-bold text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">New Book</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin-best-seller.*') ? 'active' : 'collapsed' }} " aria-current="page" href="{{ route('admin-best-seller.admin') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-like-2 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Best Seller</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin-kegiatan.*') ? 'active' : 'collapsed' }} " aria-current="page" href="{{ route('admin-kegiatan.admin') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Kegiatan</span>
          </a>
        </li>
        <li class="nav-item">
            <a data-bs-toggle="collapse" href="#pagefooter" class="nav-link {{ request()->routeIs('admin-motto.*') || request()->routeIs('admin-alamat.*') ? 'active' : 'collapsed' }}" aria-controls="pagefooter" role="button" aria-expanded="false">
              <div class="icon icon-shape icon-sm text-center d-flex align-items-center me-2 justify-content-center">
                <i class="ni ni-ungroup text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Footer</span>
            </a>
            <div class="collapse {{ request()->routeIs('admin-motto.*') || request()->routeIs('admin-alamat.*') ? 'show' : 'collapsed' }}" id="pagefooter">
              <ul class="nav ms-4">
                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin-motto.*') ? 'active' : 'collapsed' }}"  aria-current="page" href="{{ route('admin-motto.admin') }}">
                    <span class="sidenav-normal">Motto</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin-alamat.*') ? 'active' : 'collapsed' }}"  aria-current="page" href="{{ route('admin-alamat.admin') }}">
                    <span class="sidenav-normal">Alamat</span>
                  </a>
                </li>
              </ul>
            </div>
        </li>
      </ul>
      <div class="ps__rail-x" style="left: 0px; bottom: 0px"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px"></div></div>
      <div class="ps__rail-y" style="top: 0px; right: 0px"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px"></div></div>
    </div>
    <div class="sidenav-footer my-4">
      <div class="card card-plain shadow-none" id="sidenavCard">
        <img class="w-50 mx-auto my-2" src="{{ asset('Backend/assets/img/logo-perpus.png') }}" alt="sidebar_illustration" />
        <div class="card-body text-center p-3 w-100 pt-0">
          <div class="docs-info">
            <h6 class="mb-0">Perpustakaan</h6>
            <p class="text-xs font-weight-bold mb-0 text-uppercase">smk nurul islam</p>
          </div>
        </div>
      </div>
    </div>
  </aside>
