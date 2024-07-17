$(document).ready(function () {
    $("#regForm").on("submit", function (e) {
        e.preventDefault();
        let form = $(this).serialize();

        $.ajax({
            url: "register",
            method: "post",
            data: form,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                    window.location.href = "/login";
                } else {
                    $("#errorContainer").html("");
                    for (let error in response.errors) {
                        $("#errorContainer").append(
                            "<p>" + response.errors[error] + "</p>"
                        );
                    }
                    $("#errorContainer").show();
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
