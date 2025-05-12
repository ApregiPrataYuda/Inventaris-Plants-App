// Fungsi konfirmasi dengan SweetAlert2
export function confirmDelete(button) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = button.closest('form');
            form.submit();
        }
    });
}

// Attach fungsi ke window agar tersedia secara global
window.confirmDelete = confirmDelete;