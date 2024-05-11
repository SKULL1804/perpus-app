<!--   Core JS Files   -->
<script src="{{ asset('Backend/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('Backend/assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('Backend/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('Backend/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
{{-- <script src="{{ asset('Backend/assets/js/plugins/chartjs.min.js') }}"></script> --}}
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('sweetAlert2/delete.js') }}"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('Backend/assets/js/argon-dashboard.min.js') }}"></script>
<!-- Show Image -->
<script src="{{ asset('js/show-image.js') }}"></script>
<script>
    var win = navigator.platform.indexOf("Win") > -1;
    if (win && document.querySelector("#sidenav-scrollbar")) {
        var options = {
            damping: "0.5",
        };
        Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
    }
</script>
<script src="{{ asset('sweetAlert2/validation-error.js') }}"></script>

<script>
      function handleValidationResponse(response) {
        if (response.hasOwnProperty('errors')) {
            showValidationError(response.errors);
        } else if (response.hasOwnProperty('message')) {
            // Tampilkan pesan sukses jika diperlukan
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: response.message,
                });
            } else {
                console.error("SweetAlert2 is not defined. Make sure to include it before this script.");
            }
        }
    }
</script>
