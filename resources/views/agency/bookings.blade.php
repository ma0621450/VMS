<x-header></x-header>

@php
/*
$totalRevenue = 0;
foreach ($bookings as $booking) {
    $totalRevenue += $booking['price'];
}
*/
@endphp

<div class="container mt-5">
    <table class="table table-bordered table-secondary table-striped">
        <thead>
            <tr class="text-center">
                <th scope="col">Booking Id</th>
                <th scope="col">Title</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Price</th>
                <th col="col"></th>
            </tr>
        </thead>
        <tbody>
            {{-- 
            @foreach ($bookings as $booking)
                <tr class="text-center" id="booking-{{ $booking['id'] }}">
                    <td>{{ $booking['id'] }}</td>
                    <td>{{ $booking['title'] }}</td>
                    <td>{{ $booking['start_date'] }}</td>
                    <td>{{ $booking['end_date'] }}</td>
                    <td>${{ $booking['price'] }}</td>
                    <td>
                        <button class="btn btn-danger" onclick="deleteAgencyBooking(event, {{ $booking['id'] }})">Cancel</button>
                    </td>
                </tr>
            @endforeach

            @if (empty($bookings))
                <tr>
                    <td colspan="6" class="text-center">
                        <h3>No Bookings</h3>
                    </td>
                </tr>
            @endif 
            --}}
        </tbody>
    </table>
</div>

<div class="sticky-bottom bg-light py-3">
    <div class="container text-center">
        <div class="row">
            <div class="col">
                {{-- <h5>Number of Bookings: <span id="bookingCount">{{ count($bookings) }}</span></h5> --}}
            </div>
            <div class="col">
                {{-- <h5>Total Revenue: $<span id="totalRevenue">{{ number_format($totalRevenue, 2) }}</span></h5> --}}
            </div>
        </div>
    </div>
</div>

<x-footer></x-footer>

{{-- <script src="public/js/agency/bookings.js"></script> --}}
