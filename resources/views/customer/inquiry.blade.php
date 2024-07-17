<x-header></x-header>
@php
@endphp
<table class="table">
    <thead>
        <tr class="text-center">
            <th scope="col">Inquiry Id</th>
            <th scope="col">Subject</th>
            <th scope="col">Message</th>
            <th scope="col">Response</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($inquiries as $inquiry)
            <tr class="text-center" id="inquiry-{{ $inquiry->id }}">
                <td>{{ $inquiry->inquiry_id }}</td>
                <td>{{ $inquiry->subject }}</td>
                <td>{{ $inquiry->message }}</td>
                <td>
                    @if (!$inquiry->response)
                        <span class="text-secondary">No Response</span>
                    @else
                        <span class="fw-bold">{{ $inquiry->response }}</span>
                    @endif
                </td>
                <td>
                  <form action="{{ route('user.inquiry.delete', $inquiry->inquiry_id) }}" method="POST" class="d-inline delete-inquiry-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center"><h3>No Inquiries</h3></td>
            </tr>
        @endforelse
    </tbody>
</table>

<x-footer></x-footer>
<script src="{{ asset('assets/js/customer/inquiry.js') }}"></script>
