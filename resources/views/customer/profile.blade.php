<x-header></x-header>

<div class="container w-50" style="padding-bottom: 100px;">
    <h1 class="text-center text-decoration-underline">Manage your Profile</h1>
    <form action="{{ route('user.profile.update') }}" id="updateForm" class="border p-5" method="POST">
        @csrf

        <div id="errorContainer" class="alert alert-danger" style="display:none;"></div>

        <label for="old_password">Old Password</label>
        <input id="old_password" name="old_password" class="form-control mb-3" type="password">
        
        <label for="new_password">New Password</label>
        <input id="new_password" name="new_password" class="form-control mb-3" type="password">

        <button id="submit-button" type="submit" class="btn btn-success">Update Password</button>
    </form>
</div>

<x-footer></x-footer>
<script src="{{ asset('assets/js/customer/profile.js') }}"></script>