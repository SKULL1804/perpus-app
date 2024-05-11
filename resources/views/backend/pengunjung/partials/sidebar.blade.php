<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 ps ps--active-y" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-4 pt-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#">
        <img src="{{ asset('Backend/assets/img/logo-perpus.png') }}" class="navbar-brand-img h-100" alt="main_logo" />
        <span class="ms-1 font-weight-bold">Perpustakaan Nuris</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0" />
    <div class="collapse navbar-collapse w-auto h-auto ps" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home.*') ? 'active' : 'collapsed' }}" href="{{ route('home.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
            <a data-bs-toggle="collapse" href="#pagesExamples" class="nav-link {{ request()->routeIs('home-kategori*') ? 'active' : '' }}" aria-controls="pagesExamples" role="button" aria-expanded="false">
                <div class="icon icon-shape icon-sm text-center d-flex align-items-center me-2 justify-content-center">
                    <i class="ni ni-book-bookmark text-warning text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Kategori Buku</span>
            </a>
            <div class="collapse {{ request()->routeIs('home-kategori*') ? 'show' : '' }}" id="pagesExamples">
                <ul class="nav ms-4">
                    @foreach ($kategoriBuku as $kB)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home-kategori.kategori', $kB->id) }}">
                            <span class="sidenav-normal">{{ $kB->name }}</span>
                        </a>
                    </li>
                    @endforeach
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
