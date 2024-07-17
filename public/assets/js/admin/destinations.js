$(document).ready(function () {
    $("#destinationsTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/destinations/get",
        columns: [
            { data: "destination_id", name: "destination_id" },
            { data: "destination", name: "destination" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });
});
