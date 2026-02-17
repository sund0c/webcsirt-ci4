document.addEventListener("DOMContentLoaded", function () {

    if ($('#dtTable').length) {
        $('#dtTable').DataTable({
            pageLength: 10,
            lengthChange: false,
            ordering: true,
            searching: true,
            responsive: true,
            language: {
                search: "Cari:",
                paginate: {
                    previous: "←",
                    next: "→"
                },
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data"
            }
        });
    }

});
