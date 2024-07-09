<x-header></x-header>
<div style="padding-top: 50px; padding-bottom: 50px;">

    <div class="d-flex flex-column border w-50 m-auto">
        <h1 class="text-bg-success text-center p-2">Login</h1>
        <form method="POST" class="w-100 d-flex flex-column m-auto mt-2 p-3" id="loginForm" action="/login">
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
            <div class="form-group mb-3">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group mb-3">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" name="password">
            </div>
            <button type="submit" class="btn btn-success p-2 w-75 m-auto mt-3">Submit</button>
        </form>
    </div>
</div>



<x-footer></x-footer>

{{-- 
<script src="public/js/customer/login.js"></script> --}}