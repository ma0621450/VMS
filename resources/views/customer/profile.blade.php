<x-header></x-header>

<div style="padding-bottom: 100px" class="container w-50">
    <h1 class="text-center text-decoration-underline">Manage your Profile</h1>
    <form action="{{ route('user.profile.update') }}" id="updateForm" class="border p-5" method="POST">
        @csrf

        @if ($errors->has('new_username') || $errors->has('new_password'))
            <div class="alert alert-danger">
                @if ($errors->has('new_username'))
                    <p>{{ $errors->first('new_username') }}</p>
                @endif
                @if ($errors->has('new_password'))
                    <p>{{ $errors->first('new_password') }}</p>
                @endif
            </div>
        @endif

        <label for="old_password">Old Password</label>
        <input id="old_password" name="old_password" class="form-control mb-3" type="password">
        <label for="password">Password</label>
        <input id="password" name="new_password" class="form-control mb-3" type="password">
        <div id="button-container" style="gap: 5px;" class="d-flex justify-content-center">
            <button id="submit-button" type="submit" class="btn btn-success hidden">Submit</button>
        </div>
    </form>
</div>

<x-footer></x-footer>

{{-- <script src="{{ asset('public/js/customer/profile.js') }}"></script> --}}
