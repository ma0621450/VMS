$(document).ready(function () {
    $("#inquiryForm").on("submit", function (e) {
        e.preventDefault();

        var form = $(this);
        var formData = form.serialize();
        var errorContainer = $("#errorContainer");

        $.ajax({
            type: "POST",
            url: form.attr("action"),
            data: formData,
            dataType: "json",
            success: function (response) {
                errorContainer.hide().html("");
                if (response.success) {
                    errorContainer
                        .removeClass("alert-danger")
                        .addClass("alert-success")
                        .html("<p>Inquiry submitted successfully!</p>")
                        .show();

                    form.trigger("reset");
                } else {
                    errorContainer
                        .removeClass("alert-success")
                        .addClass("alert-danger");

                    if (response.errors) {
                        for (var error in response.errors) {
                            errorContainer.append(
                                "<p>" + response.errors[error] + "</p>"
                            );
                        }
                    } else {
                        errorContainer.html(
                            "<p>An unexpected error occurred. Please try again.</p>"
                        );
                    }
                    errorContainer.show();
                }
            },
            error: function () {
                errorContainer
                    .removeClass("alert-success")
                    .addClass("alert-danger")
                    .html(
                        "<p>An unexpected error occurred. Please try again.</p>"
                    )
                    .show();
            },
        });
    });
});
