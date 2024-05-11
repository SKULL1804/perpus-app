@extends('backend.pengunjung.layouts.app')

@section('content')
<div class="container-fluid py-4">
    @if ($historyBaca && $historyBaca->ketBuku)
        <a href="{{ route('selesai-baca', ['id' => $daftarBuku->id]) }}" class="btn btn-primary">Selesai Baca</a>
        <a href="{{ route('berhenti-baca', ['id' => $daftarBuku->id]) }}" class="btn btn-warning">Berhenti Baca</a>
    @else
        <p>Status Bacaan: {{ $historyBaca->ketBuku->status }}</p>
    @endif

    <style>
        .ratio {
            position: relative;
            width: 100%;
        }

        .ratio iframe {
            position: absolute;
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 10px;
            background-color: #f0f0f0; /* Ubah warna latar belakang sesuai kebutuhan */
        }

        .containe {
            margin: 5pc 1pc;
        }

    </style>

    <div class="ratio ratio-4x3">
        <iframe id="pdfViewer" frameborder="0"></iframe>
    </div>

    <div class="containe">
        <button id="prevPageBtn" class="btn btn-primary">Previous</button>
        <button id="nextPageBtn" class="btn btn-primary">Next</button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
    <script>
        // Lokasi file PDF
        var url = "{{ asset('Backend/assets/document/' . $daftarBuku->file_buku) }}";

        // Inisialisasi PDF.js
        pdfjsLib.getDocument(url).promise.then(function(pdf) {
            // console.log('Jumlah halaman:', pdf.numPages);

            // // Iterasi setiap halaman
            // for (var pageNumber = 1; pageNumber <= pdf.numPages; pageNumber++) {
            //     pdf.getPage(pageNumber).then(function(page) {
            //         // Ambil konten teks dari halaman
            //         return page.getTextContent();
            //     }).then(function(textContent) {
            //         // Proses konten teks di sini
            //         console.log('Konten teks halaman:', textContent);
            //     });
            // }

            // Ambil jumlah halaman
            var numPages = pdf.numPages;

            // Fungsi untuk menampilkan halaman tertentu
            function showPage(pageNumber) {
                pdf.getPage(pageNumber).then(function(page) {
                    var canvas = document.createElement('canvas');
                    var context = canvas.getContext('2d');

                    // Get the device width
                    var deviceWidth = window.innerWidth ||
                                    document.documentElement.clientWidth ||
                                    document.body.clientWidth;

                    // Define scale based on device width
                    var scale;
                    if (deviceWidth < 600) { // Mobile devices
                        scale = 0.5;
                    } else if (deviceWidth < 1024) { // Tablets
                        scale = 1.2;
                    } else { // Desktop
                        scale = 1.7;
                    }

                    var viewport = page.getViewport({ scale: scale });

                    canvas.width = viewport.width;
                    canvas.height = viewport.height;
                    var renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    page.render(renderContext).promise.then(function() {
                        // Mengganti konten iframe dengan gambar dari canvas
                        var iframe = document.getElementById('pdfViewer');
                        iframe.src = canvas.toDataURL();
                        iframe.dataset.page = pageNumber;
                    });
                });
            }

            // Tampilkan halaman pertama saat PDF pertama dimuat
            showPage(1);

            // Fungsi untuk menampilkan halaman berikutnya
            function nextPage() {
                var iframe = document.getElementById('pdfViewer');
                var currentPage = parseInt(iframe.dataset.page) || 1;
                if (currentPage < numPages) {
                    // Tambahkan kelas CSS untuk animasi flipbook
                    iframe.classList.add('next');
                    currentPage++;
                    setTimeout(function() {
                        showPage(currentPage);
                        // Hapus kelas CSS setelah animasi selesai
                        setTimeout(function() {
                            iframe.classList.remove('next');
                        }, 500);
                    }, 500);
                }
            }

            // Fungsi untuk menampilkan halaman sebelumnya
            function prevPage() {
                var iframe = document.getElementById('pdfViewer');
                var currentPage = parseInt(iframe.dataset.page) || 1;
                if (currentPage > 1) {
                    // Tambahkan kelas CSS untuk animasi flipbook
                    iframe.classList.add('prev');
                    currentPage--;
                    setTimeout(function() {
                        showPage(currentPage);
                        // Hapus kelas CSS setelah animasi selesai
                        setTimeout(function() {
                            iframe.classList.remove('prev');
                        }, 500);
                    }, 500);
                }
            }

            // Tambahkan event listener untuk tombol next dan prev
            document.getElementById('nextPageBtn').addEventListener('click', nextPage);
            document.getElementById('prevPageBtn').addEventListener('click', prevPage);
        });
    </script>

</div>
@endsection
