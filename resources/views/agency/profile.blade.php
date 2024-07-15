<x-header></x-header>

<div style="padding-bottom: 100px;" class="container w-50">
    <h6 class="text-center">Note: Agency Name and Description is required to create packages.</h6>
    <h1 class="text-center text-decoration-underline">Manage Your Profile</h1>

    @if ($errors->has('agency_name') || $errors->has('agency_desc'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->get('agency_name') as $error)
                    <li>{{ $error }}</li>
                @endforeach
                @foreach ($errors->get('agency_desc') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('agency.profile.update') }}" class="border p-3" method="POST">
        @csrf
        <label for="agency_name">Travel Agency Name</label>
        <input name="agency_name" class="form-control mb-3" type="text" value="{{ old('agency_name', $formValues['agency_name'] ?? '') }}" />

        <label for="agency_desc">About Agency</label>
        <textarea rows="5" name="agency_desc" class="form-control mb-3">{{ old('agency_desc', $formValues['agency_desc'] ?? '') }}</textarea>

        <button class="btn btn-success" type="submit">Submit</button>
    </form>
</div>

<div style="padding-bottom: 100px;" class="container w-50">
    <h1 class="text-center text-decoration-underline">Change Password</h1>

    @if ($errors->has('old_password') || $errors->has('new_password') || $errors->has('new_password_confirmation'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->get('old_password') as $error)
                    <li>{{ $error }}</li>
                @endforeach
                @foreach ($errors->get('new_password') as $error)
                    <li>{{ $error }}</li>
                @endforeach
                @foreach ($errors->get('new_password_confirmation') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('agency.password.update') }}" class="border p-3" method="POST">
        @csrf
        @method('PUT')
        <label for="old_password">Current Password</label>
        <input name="old_password" class="form-control mb-3" type="password" />

        <label for="new_password">New Password</label>
        <input name="new_password" class="form-control mb-3" type="password" />

        <label for="new_password_confirmation">Confirm New Password</label>
        <input name="new_password_confirmation" class="form-control mb-3" type="password" />

        <button class="btn btn-success" type="submit">Submit</button>
    </form>
</div>

<x-footer></x-footer>
