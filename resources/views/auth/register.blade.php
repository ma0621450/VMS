<x-header></x-header>

<div style="padding-top: 50px; padding-bottom: 50px;">
    <div class="d-flex flex-column border w-50 m-auto">
        <h1 class=" text-center text-bg-success p-3 rounded-2 fs-1">Register</h1>
        <form class="w-100 d-flex flex-column m-auto mt-2 p-3" id="regForm" action="/register" method="POST">
            @csrf
                  @if ($errors->any())
                <div id="errorContainer" class="alert alert-danger pt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div id="errorContainer" class="alert alert-danger pt-3" style="display:none;"></div>
            <div class="form-group mb-3">
                <label for="email">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
            </div>
            <div class="form-group mb-3">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group mb-3">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" name="password">
            </div>
            <div class="form-group mb-3">
                <label for="pwd">Phone Number:</label>
                <input class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                    >
            </div>
            <div class="input-group mb-3">
                <select style="width:100%; padding:4px" class="" name="role_id" id="">
                    <option>Please select your type</option>
                    <option value="2">Travel Agency</option>
                    <option value="3">Traveler</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success w-75 m-auto mt-3 p-2">Submit</button>
        </form>

    </div>
</div>



<x-footer></x-footer>


{{-- <script src="public/js/customer/register.js"></script> --}}