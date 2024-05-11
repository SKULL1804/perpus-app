<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 ps ps--active-y" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#">
        <img src="{{ asset('Backend/assets/img/logo-perpus.png') }}" class="navbar-brand-img h-100" alt="main_logo" />
        <span class="font-weight-bold">Super Admin Dashboard</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0" />
    <div class="collapse navbar-collapse w-auto h-auto ps" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : 'collapsed' }}"  aria-current="page" href="{{ route('dashboard.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('data-pengunjung.*') ? 'active' : 'collapsed' }}"  aria-current="page" href="{{ route('data-pengunjung.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Data Pengunjung</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('daftar-buku.*') ? 'active' : 'collapsed' }}"  aria-current="page" href="{{ route('daftar-buku.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-book-bookmark text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Daftar Buku</span>
          </a>
        </li>
        <li class="nav-item">
            <a data-bs-toggle="collapse" href="#anggota" class="nav-link {{ request()->routeIs('anggota-perpustakaan.*') || request()->routeIs('anggota-pengunjung.*') ? 'active' : 'collapsed' }}" aria-controls="pagesExamples" role="button" aria-expanded="false">
              <div class="icon icon-shape icon-sm text-center d-flex align-items-center me-2 justify-content-center">
                <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Anggota</span>
            </a>
            <div class="collapse  {{ request()->routeIs('anggota-perpustakaan.*') || request()->routeIs('anggota-pengunjung.*')  ? 'show' : 'collapsed' }}" id="anggota">
              <ul class="nav ms-4">
                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('anggota-perpustakaan.*') ? 'active' : 'collapsed' }} " aria-current="page" href="{{ route('anggota-perpustakaan.index') }}">
                    <span class="sidenav-normal">Anggota Perpustakaan</span></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('anggota-pengunjung.*') ? 'active' : 'collapsed' }} " aria-current="page" href="{{ route('anggota-pengunjung.index') }}">
                    <span class="sidenav-normal">Anggota Pengunjung</span></span>
                  </a>
                </li>
              </ul>
            </div>
        </li>
        <li class="nav-item">
            <a data-bs-toggle="collapse" href="#history" class="nav-link {{ request()->routeIs('history-pengunjung.*') || request()->routeIs('history-buku.*') ? 'active' : 'collapsed' }}" aria-controls="pagesExamples" role="button" aria-expanded="false">
              <div class="icon icon-shape icon-sm text-center d-flex align-items-center me-2 justify-content-center">
                <i class="fa-solid fa-clock-rotate-left text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">History</span>
            </a>
            <div class="collapse  {{ request()->routeIs('history-pengunjung.*') || request()->routeIs('history-buku.*')  ? 'show' : 'collapsed' }}" id="history">
              <ul class="nav ms-4">
                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('history-pengunjung.*') ? 'active' : 'collapsed' }} " aria-current="page" href="{{ route('history-pengunjung.index') }}">
                    <span class="sidenav-normal">History Pengunjung</span></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('history-buku.*') ? 'active' : 'collapsed' }} " aria-current="page" href="{{ route('history-buku.index') }}">
                    <span class="sidenav-normal">History Buku</span></span>
                  </a>
                </li>
              </ul>
            </div>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#kategori" class="nav-link {{ request()->routeIs('kategori.*') || request()->routeIs('kelas.*') || request()->routeIs('jurusan.*')  ? 'active' : 'collapsed' }}" aria-controls="pagesExamples" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center me-2 justify-content-center">
              <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Kategori</span>
          </a>
          <div class="collapse {{ request()->routeIs('kategori.*') || request()->routeIs('kelas.*') || request()->routeIs('jurusan.*')  ? 'show' : 'collapsed' }}" id="kategori">
            <ul class="nav ms-4">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : 'collapsed' }}"  aria-current="page" href="{{ route('kategori.index') }}">
                  <span class="sidenav-normal">Kategori Buku</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('kelas.*') ? 'active' : 'collapsed' }}"  aria-current="page" href="{{ route('kelas.index') }}">
                  <span class="sidenav-normal">Kelas</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('jurusan.*') ? 'active' : 'collapsed' }}"  aria-current="page" href="{{ route('jurusan.index') }}">
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
          <a class="nav-link {{ request()->routeIs('about.*') ? 'active' : 'collapsed' }}"  aria-current="page" href="{{ route('about.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-shop text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">About</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('new-book.*') ? 'active' : 'collapsed' }}"  aria-current="page" href="{{ route('new-book.superAdmin') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-check-bold text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">New Book</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('best-seller.*') ? 'active' : 'collapsed' }}"  aria-current="page" href="{{ route('best-seller.superAdmin') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-like-2 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Best Book</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('kegiatan.*') ? 'active' : 'collapsed' }}"  aria-current="page" href="{{ route('kegiatan.superAdmin') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Kegiatan</span>
          </a>
        </li>
        <li class="nav-item">
            <a data-bs-toggle="collapse" href="#pagefooter" class="nav-link {{ request()->routeIs('motto.*') || request()->routeIs('alamat.*') ? 'active' : 'collapsed' }}" aria-controls="pagefooter" role="button" aria-expanded="false">
              <div class="icon icon-shape icon-sm text-center d-flex align-items-center me-2 justify-content-center">
                <i class="ni ni-ungroup text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Footer</span>
            </a>
            <div class="collapse  {{ request()->routeIs('motto.*') || request()->routeIs('alamat.*') ? 'show' : 'collapsed' }}" id="pagefooter">
              <ul class="nav ms-4">
                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('motto.*') ? 'active' : 'collapsed' }}"  aria-current="page" href="{{ route('motto.superAdmin') }}">
                    <span class="sidenav-normal">Motto</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('alamat.*') ? 'active' : 'collapsed' }}"  aria-current="page" href="{{ route('alamat.superAdmin') }}">
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
