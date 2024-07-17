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
                    updateBookingCountAndRevenue(response.price);
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

function updateBookingCountAndRevenue(price) {
    console.log("Price received:", price);

    var bookingCountElement = $("#bookingCount");
    var currentBookingCount = parseInt(bookingCountElement.text());
    bookingCountElement.text(currentBookingCount - 1);

    var totalRevenueElement = $("#totalRevenue");
    var currentTotalRevenue = parseFloat(
        totalRevenueElement.text().replace(/[^\d.-]/g, "")
    );
    var priceValue = parseFloat(price);

    console.log("Current total revenue:", currentTotalRevenue);
    console.log("Price value:", priceValue);

    if (!isNaN(priceValue)) {
        var newTotalRevenue = currentTotalRevenue - priceValue;
        totalRevenueElement.text(newTotalRevenue.toFixed(2));
        console.log("New total revenue:", newTotalRevenue);
    }
}
