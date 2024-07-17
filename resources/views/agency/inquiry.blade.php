<x-header></x-header>

<div class="container mt-5">
    <table class="table table-bordered table-secondary table-striped">
        <thead>
            <tr class="text-center">
                <th scope="col">Inquiry Id</th>
                <th scope="col">Subject</th>
                <th scope="col">Message</th>
                <th scope="col">Response</th>
                <th scope="col">Vacation Package Id</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inquiries as $inquiry)
                <tr class="text-center">
                    <td>{{ $inquiry->inquiry_id }}</td>
                    <td>{{ $inquiry->subject }}</td>
                    <td>{{ $inquiry->message }}</td>
                    <td class="response-column">
                        @if (!$inquiry->response)
                            <form action="{{ route('agency.inquiry.respond') }}" method="POST" class="response-form d-flex flex-column align-items-center justify-content-center w-auto">
                                @csrf
                                <input type="hidden" name="inquiry_id" value="{{ $inquiry->inquiry_id }}">
                                <textarea class="form-control response-textarea" rows="1" name="response"></textarea>
                                <button type="submit" class="btn btn-primary mt-2">Send Response</button>
                            </form>
                        @else
                            {{ $inquiry->response }}
                        @endif
                    </td>
                    <td>
                        <a class="text-decoration-underline" href="{{ route('package.edit', $inquiry->vp_id) }}">
                            {{ $inquiry->vp_id }}
                        </a>
                    </td>
                </tr>
            @endforeach
            @if ($inquiries->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">
                        <h3>No Inquiries</h3>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<x-footer></x-footer>

<script src="{{ asset('assets/js/agency/inquiry.js') }}"></script>
