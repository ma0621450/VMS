$(document).ready(function () {
    $("#updatePackageForm").on("submit", function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = form.serialize();

        $.ajax({
            url: form.attr("action"),
            method: "POST",
            data: formData,
            success: function (response) {
                if (response.success) {
                    console.log("Package Updated successfully!");
                    window.location.reload();
                } else {
                    console.error("Unexpected response format.");
                }
            },
            error: function (xhr) {
                handleErrors(xhr);
            },
        });
    });

    function handleErrors(xhr) {
        $("#errorContainer").html(""); // Clear previous errors

        if (xhr.responseJSON && xhr.responseJSON.errors) {
            let errors = xhr.responseJSON.errors;
            $.each(errors, function (key, value) {
                $("#errorContainer").append("<p>" + value + "</p>");
            });
        } else {
            $("#errorContainer").html(
                "<p>An unexpected error occurred. Please try again.</p>"
            );
        }

        $("#errorContainer").show(); // Show error messages
    }
});
