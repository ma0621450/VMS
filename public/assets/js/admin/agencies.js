$(document).ready(function () {
    var agenciesTable = $("#agenciesTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/agencies/get",
        columns: [
            { data: "user_id", name: "user_id" },
            { data: "username", name: "username" },
            { data: "travel_agency_name", name: "travel_agency_name" },
            { data: "email", name: "email" },
            { data: "phone_number", name: "phone_number" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });
});
