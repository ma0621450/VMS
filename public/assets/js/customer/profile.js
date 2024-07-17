$(document).ready(function () {
    $("#updateForm").on("submit", function (event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr("action"),
            method: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    alert("Password updated successfully.");
                    $("#updateForm")[0].reset();
                } else {
                    $("#errorContainer").html("");
                    $("#errorContainer").show();

                    if (response.errors) {
                        $.each(response.errors, function (key, value) {
                            $("#errorContainer").append("<p>" + value + "</p>");
                        });
                    } else {
                        $("#errorContainer").append(
                            "<p>" + response.message + "</p>"
                        );
                    }
                }
            },
            error: function () {
                alert("Request failed. Please try again later.");
            },
        });
    });
});
