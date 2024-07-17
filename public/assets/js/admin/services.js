$(document).ready(function () {
    $("#servicesTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/services/get",
        columns: [
            { data: "service_id", name: "service_id" },
            { data: "service", name: "service" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });
});
