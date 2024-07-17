$(document).ready(function () {
    $(".delete-inquiry-form").on("submit", function (event) {
        event.preventDefault();

        if (!confirm("Are you sure you want to delete this inquiry?")) {
            return;
        }

        var form = $(this);
        var inquiryId = form.find("input[name='inquiry_id']").val();

        $.ajax({
            type: "POST",
            url: form.attr("action"),
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                console.log("Response:", response);
                if (response.success) {
                    form.closest("tr").remove();
                    alert("Inquiry deleted successfully.");
                } else {
                    alert("Failed to delete inquiry: " + response.message);
                }
            },
            error: function () {
                alert("Request failed. Please try again later.");
            },
        });
    });
});
