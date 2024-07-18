$(document).ready(function () {
    var agenciesTable = $("#agenciesTable").DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: "/admin/agencies/get",
            dataSrc: "data",
        },
        columns: [
            { data: "user_id" },
            { data: "username" },
            { data: "travel_agency.travel_agency_name", defaultContent: "-" },
            { data: "email" },
            { data: "phone_number" },
            {
                data: null,
                render: function (data, type, row) {
                    var buttonClass =
                        data.deleted_at === null
                            ? "btn-danger block-button"
                            : "btn-success unblock-button";
                    var buttonText =
                        data.deleted_at === null ? "Block" : "Unblock";
                    return `<button class="btn ${buttonClass}" data-id="${data.user_id}">${buttonText}</button>`;
                },
            },
        ],
    });

    // Event delegation for block/unblock buttons
    $("#agenciesTable").on(
        "click",
        ".block-button, .unblock-button",
        function () {
            var userId = $(this).data("id");
            var action = $(this).hasClass("block-button") ? "block" : "unblock";
            performAction(userId, action);
        }
    );

    function performAction(userId, action) {
        var url =
            action === "block"
                ? `/admin/agencies/block/${userId}`
                : `/admin/agencies/unblock/${userId}`;

        $.ajax({
            url: url,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                var actionText = action === "block" ? "blocked" : "unblocked";
                console.log(`Agency ${actionText} successfully!`);
                alert(`Agency ${actionText} successfully!`);
                agenciesTable.ajax.reload();
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert(`Failed to ${action} agency. Please try again.`);
            },
        });
    }
});
