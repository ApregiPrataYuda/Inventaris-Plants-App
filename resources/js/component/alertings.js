document.addEventListener('DOMContentLoaded', function () {
    var flashMessage = document.getElementById('flash').dataset.flash;
    if (flashMessage) {
        Swal.fire({
        icon: "success",
        title: flashMessage,
        showConfirmButton: false,
        timer: 1500
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    var flashMessage = document.getElementById('flashError').dataset.flash;
    if (flashMessage) {
        Swal.fire({
            title: 'Error!',
            text: flashMessage,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
});


document.addEventListener('DOMContentLoaded', function () {
    var flashMessage = document.getElementById('flashInfo').dataset.flash;
    if (flashMessage) {
        Swal.fire({
        title: "Warning?",
        text: flashMessage,
        icon: "question"
        });
    }
});