$(document).ready(function () {
    $("#profile-update-form").on("submit", function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                console.log(response);
                alert("Profile updated successfully!");
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred. Please try again.");
            },
        });
    });

    $("#password-update-form").on("submit", function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                console.log(response);
                alert("Password updated successfully!");
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred. Please try again.");
            },
        });
    });
});
