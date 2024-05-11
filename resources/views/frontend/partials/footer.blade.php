<footer id="footer" class="footer">
    <div class="container">
      <div class="footer-content pt-4 pt-lg-5">
        <h1 class="text-center">{{ $motto->ajakan }}</h1>
        <p class="pt-2 text-center">
            {{ $motto->motto }}
            {{-- <a href="https://smknurulislam.sch.id/" class="p-1 p-lg-2 p-md-2">SMK Nurul Islam</a> --}}
        </p>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="alamat pt-2 pt-lg-3">
            <h1>Perpustakaan Nuris</h1>
            <p class="mb-2">{{ $alamat->alamat }}</p>
            <p>{{ $alamat->email }}</p>
          </div>
        </div>
        <div class="col-lg-8 col-md-6">
          <div class="feature pe-lg-0 pt-lg-4 pt-md-4">
            <a href="#about" class="py-2 px-4">About</a>
            <a href="#new" class="py-2 px-4">New Book</a>
            <a href="#best" class="py-2 px-4">Best Seller</a>
            <a href="#kegiatan" class="py-2 px-4">Kegiatan</a>
          </div>
          <div class="sosmed pt-3 pt-lg-4 pe-lg-0">
            <a href="https://www.instagram.com/perpustakaansmknurulislam/" target="_blank"><i class="bi bi-instagram py-2 px-2"></i></a>
          </div>
          <div class="copyright p-4 pe-lg-0 pe-md-0">
            <h1>Perpustakaan Nuris &copy; 2023</h1>
            <p>Design by RPL angakatan ke 2</p>
          </div>
        </div>
      </div>
    </div>
</footer>
