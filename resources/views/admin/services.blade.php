<x-header></x-header>

<div class="container">
    <div class="d-flex flex-column border-2 w-50 m-auto pb-3">
        <h3 class="text-bg-success text-center p-2">Add Service</h3>
        <form class="m-auto w-75 d-flex flex-column" method="POST" action="{{ route('admin.service.post') }}">
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
            <input class="form-control mb-3" type="text" name="service" placeholder="Enter service description" value="">
            <button class="btn btn-success w-50 p-2 m-auto" type="submit">Add</button>
        </form>
    </div>

    <div class="container mt-5">
        <h4>All Services</h4>
        <table id="servicesTable" class="table table-bordered w-75">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Service</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
            </tbody>
        </table>
    </div>
</div>

<x-footer></x-footer>
<script src="{{ asset('assets/js/admin/services.js') }}"></script>
