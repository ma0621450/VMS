$(document).ready(function () {
    var usersTable = $("#usersTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/customers/get",
        columns: [
            { data: "user_id", name: "user_id" },
            { data: "username", name: "username" },
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
