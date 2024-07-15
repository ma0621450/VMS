<x-header></x-header>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Booking Id</th>
            <th scope="col">Title</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Price</th>
            <th scope="col">View</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($bookings as $booking)
            <tr id="booking-{{ $booking->id }}">
                <td>{{ $booking->booking_id }}</td>
                <td>{{ $booking->vacation_title }}</td>
                <td>{{ $booking->start_date }}</td>
                <td>{{ $booking->end_date }}</td>
                <td>${{ $booking->price }}</td>
                <td><a href="{{ route('package.show', $booking->vp_id) }}">View Package</a></td>
                <td>
                      <form action="{{ route('package.booking.delete', $booking->booking_id) }}" method="POST" class="d-inline delete-booking-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center"><h1>No Bookings</h1></td>
            </tr>
        @endforelse
    </tbody>
</table>

<x-footer></x-footer>
{{-- <script src="{{ asset('js/customer/bookings.js') }}"></script> --}}
