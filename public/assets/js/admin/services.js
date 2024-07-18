$(document).ready(function () {
    var servicesTable = $("#servicesTable").DataTable({
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
                render: function (data, type, row) {
                    return (
                        '<button class="btn btn-danger deleteServiceBtn" data-id="' +
                        row.service_id +
                        '">Delete</button>'
                    );
                },
            },
        ],
    });

    // Add Service Form Submission
    $("#addServiceForm").submit(function (event) {
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
                alert("Service added successfully!");
                $("#serviceInput").val("");
                servicesTable.ajax.reload();
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
                    alert("Failed to add service. Please try again.");
                }
            },
        });
    });

    // Delete Service
    $("#servicesTable").on("click", ".deleteServiceBtn", function () {
        var serviceId = $(this).data("id");

        if (confirm("Are you sure you want to delete this service?")) {
            $.ajax({
                url: "/admin/services/" + serviceId,
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    alert("Service deleted successfully!");
                    servicesTable.ajax.reload();
                },
                error: function (xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        alert(xhr.responseJSON.error);
                    } else {
                        alert("Failed to delete service. Please try again.");
                    }
                },
            });
        }
    });
});
