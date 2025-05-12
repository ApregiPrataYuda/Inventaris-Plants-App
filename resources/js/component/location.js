

document.addEventListener("DOMContentLoaded", function () {
    let metaTag = document.querySelector('meta[name="Admin-location-plants-get"]');
    let requestUrlCategory = metaTag ? metaTag.content : null;

    if (!requestUrlCategory) {
        console.error("Meta tag Route Not found.");
        return; // Hentikan eksekusi jika tidak ada URL
    }

    let catTable = document.getElementById("locationTable");
    if (!catTable) {
        console.error("Table tidak ditemukan di halaman ini.");
        return;
    }

    $("#locationTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: requestUrlCategory,
            type: "GET",
            headers: {
                'X-Requested-With': 'XMLHttpRequest', // **Pastikan ini ada**
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "name_locations", name: "name_locations" },
            { data: "description_locations", name: "description_locations" },
            { data: "action", name: "action", orderable: false, searchable: true },
        ],
        responsive: true,
        autoWidth: false,
        language: {
            processing: "Loading Data...",
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "No entries to show",
            infoFiltered: "(filtered from _MAX_ total entries)",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous",
            },
            zeroRecords: "No matching records found",
        },
    });


    
});

