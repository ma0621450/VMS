<x-header></x-header>

<div class="container mt-5">
    <table class="table table-bordered table-secondary table-striped">
        <thead>
            <tr class="text-center">
                <th scope="col">Booking Id</th>
                <th scope="col">Title</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Price</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr class="text-center" id="booking-{{ $booking->booking_id }}">
                    <td>{{ $booking->booking_id }}</td>
                    <td>{{ $booking->vp->title }}</td>
                    <td>{{ $booking->start_date }}</td>
                    <td>{{ $booking->end_date }}</td>
                    <td>${{ $booking->price }}</td>
                    <td>
                        <form class="delete-booking-form" action="{{ route('agency.booking.cancel', $booking->booking_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="booking_id" value="{{ $booking->booking_id }}">
                            <button type="submit" class="btn btn-danger delete-booking">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach

            @if ($bookings->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">
                        <h3>No Bookings</h3>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<div class="sticky-bottom bg-light py-3">
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <h5>Number of Bookings: <span id="bookingCount">{{ $bookings->count() }}</span></h5>
            </div>
            <div class="col">
                @php
                    $totalRevenue = $bookings->sum('price');
                @endphp
                <h5>Total Revenue: $<span id="totalRevenue">{{ $totalRevenue }}</span></h5>
            </div>
        </div>
    </div>
</div>

<x-footer></x-footer>
<script src="{{ asset('assets/js/agency/bookings.js') }}"></script>
