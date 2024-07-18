$(document).ready(function () {
    var destinationsTable = $("#destinationsTable").DataTable({
        ajax: {
            url: "/admin/destinations/get",
            type: "GET",
            dataSrc: "destination",
        },
        columns: [
            { data: "destination_id", name: "destination_id" },
            { data: "destination", name: "destination" },
            {
                data: null,
                name: "action",
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return (
                        '<button class="btn btn-danger deleteDestinationBtn" data-id="' +
                        row.destination_id +
                        '">Delete</button>'
                    );
                },
            },
        ],
        error: function (xhr, error, thrown) {
            console.log("Error fetching data:", error);
        },
    });
});

$("#addDestinationForm").submit(function (event) {
    event.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
        url: $(this).attr("action"),
        type: "POST",
        data: formData,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            alert("Destination added successfully!");
            $("#destinationInput").val("");
            destinationsTable.ajax.reload();
        },
        error: function (xhr) {
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                var errors = xhr.responseJSON.errors;
                var errorMsg = "";
                Object.values(errors).forEach(function (err) {
                    errorMsg += err + "\n";
                });
                alert(errorMsg);
            } else {
                alert("Failed to add destination. Please try again.");
            }
        },
    });
});

$(document).ready(function () {
    $("#destinationsTable").on("click", ".deleteDestinationBtn", function () {
        var destinationId = $(this).data("id");

        if (confirm("Are you sure you want to delete this destination?")) {
            $.ajax({
                url: "/admin/destinations/" + destinationId,
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    alert("Destination deleted successfully!");
                    destinationsTable.ajax.reload();
                },
                error: function (xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        alert(xhr.responseJSON.error);
                    } else {
                        alert(
                            "Failed to delete destination. Please try again."
                        );
                    }
                },
            });
        }
    });
});
