

document.addEventListener("DOMContentLoaded", function () {
    let metaTag = document.querySelector('meta[name="Employe-plants-get"]');
    let requestUrlplants = metaTag ? metaTag.content : null;

    if (!requestUrlplants) {
        console.error("Meta tag Route Not found.");
        return; // Hentikan eksekusi jika tidak ada URL
    }

    let catTable = document.getElementById("plantsTable");
    if (!catTable) {
        console.error("Table tidak ditemukan di halaman ini.");
        return;
    }

    $("#plantsTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: requestUrlplants,
            type: "GET",
            headers: {
                'X-Requested-With': 'XMLHttpRequest', // **Pastikan ini ada**
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "name", name: "name" },
            { data: "code_plants", name: "code_plants" },
            { data: "category_name", name: "category_name" },
            { data: "location_name", name: "location_name" },
            { data: "status", name: "status" },
            { data: "image", name: "image" },
            { data: "details", name: "details" },
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


$(document).on('click', '#sets', function() {
    var cp = $(this).data('cp');
    var pd = $(this).data('pd');
    var sn = $(this).data('sn');
    var nt = $(this).data('nt');
  

   $('#cp').text(cp);  
   $('#pd').text(pd);  
   $('#sn').text(sn);  
   $('#nt').text(nt);  
  
 })
