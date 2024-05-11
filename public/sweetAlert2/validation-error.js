function showValidationError(errors) {
    if (typeof Swal !== 'undefined') {
        let errorMessages = '<div>';

        for (const key in errors) {
            if (errors.hasOwnProperty(key)) {
                errorMessages += `<div>${errors[key][0]}</div>`;
            }
        }

        errorMessages += '</div>';

        Swal.fire({
            icon: 'error',
            title: 'Validasi Gagal',
            html: errorMessages,
        });
    } else {
        console.error("SweetAlert2 is not defined. Make sure to include it before this script.");
    }
}
