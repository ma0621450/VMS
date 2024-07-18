$(document).ready(function () {
    var usersTable = $("#usersTable").DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: "/admin/customers/get",
            dataSrc: "data",
        },
        columns: [
            { data: "user_id" },
            { data: "username" },
            { data: "email" },
            { data: "phone_number" },
            {
                data: null,
                render: function (data, type, row) {
                    if (data.deleted_at === null) {
                        return `<button class="btn btn-danger block-button" data-id="${data.user_id}">Block</button>`;
                    } else {
                        return `<button class="btn btn-success unblock-button" data-id="${data.user_id}">Unblock</button>`;
                    }
                },
            },
        ],
    });

    // Block button click handler
    $("#usersTable").on("click", ".block-button", function () {
        var userId = $(this).data("id");
        blockUser(userId);
    });

    $("#usersTable").on("click", ".unblock-button", function () {
        var userId = $(this).data("id");
        unblockUser(userId);
    });

    function blockUser(userId) {
        $.ajax({
            url: `/admin/customers/block/${userId}`,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                alert("User blocked successfully!");
                usersTable.ajax.reload();
            },
            error: function (xhr) {
                alert("Failed to block user. Please try again.");
            },
        });
    }

    function unblockUser(userId) {
        $.ajax({
            url: `/admin/customers/unblock/${userId}`,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                alert("User unblocked successfully!");
                usersTable.ajax.reload(); // Reload the DataTable upon success
            },
            error: function (xhr) {
                alert("Failed to unblock user. Please try again.");
            },
        });
    }
});
