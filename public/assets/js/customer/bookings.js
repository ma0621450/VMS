$(document).ready(function () {
    $(".delete-booking-form").on("submit", function (event) {
        event.preventDefault();

        if (!confirm("Are you sure you want to delete this booking?")) {
            return;
        }

        var form = $(this);
        var bookingId = form.find("input[name='booking_id']").val();

        $.ajax({
            type: "DELETE",
            url: form.attr("action"),
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                console.log("Response:", response);
                if (response.success) {
                    form.closest("tr").remove();
                    alert("Booking deleted successfully.");
                } else {
                    alert("Failed to delete booking: " + response.message);
                }
            },
            error: function () {
                alert("Request failed. Please try again later.");
            },
        });
    });
});
