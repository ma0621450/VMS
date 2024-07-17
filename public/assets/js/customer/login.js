$(document).ready(function () {
    $("#loginForm").on("submit", function (e) {
        e.preventDefault();
        let form = $(this).serialize();

        $.ajax({
            url: "login",
            method: "post",
            data: form,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    window.location.href = response.redirect;
                }
            },
            error: function (xhr) {
                $("#errorContainer").html("");
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    for (let error in errors) {
                        $("#errorContainer").append(
                            "<p>" + errors[error] + "</p>"
                        );
                    }
                } else {
                    $("#errorContainer").html(
                        "<p>An unexpected error occurred. Please try again.</p>"
                    );
                }
                $("#errorContainer").show();
            },
        });
    });
});
