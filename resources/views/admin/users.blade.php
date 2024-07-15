<x-header></x-header>

<div class="d-flex justify-content-center">
    <button class="m-1 btn btn-success" id="toggleTable1">Users</button>
    <button class="m-1 btn btn-success" id="toggleTable2">Travel Agencies</button>
</div>

<table class="table table-bordered table-secondary table-striped" id="myTable">
    <thead>
        <tr>
            <th>User Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer['user_id'] }}</td>
                <td>{{ $customer['username'] }}</td>
                <td>{{ $customer['email'] }}</td>
                <td>{{ $customer['phone_number'] }}</td>
                <td class="d-flex align-items-center">
                    <a href="{{ route('admin.bookings', ['user_id' => $customer['user_id']]) }}"
                        class="btn btn-primary mx-1">View Bookings</a>
                    @if (is_null($customer['deleted_at']))
                        <form class="block-form" method="post">
                            @method('DELETE')
                            <input type="hidden" name="user_id" value="{{ $customer['user_id'] }}">
                            <button type="submit" class="btn btn-danger block-button">Block</button>
                        </form>
                    @else
                        <form class="unblock-form" method="post">
                            @method('PATCH')
                            <input type="hidden" name="user_id" value="{{ $customer['user_id'] }}">
                            <button type="submit" class="btn btn-success unblock-button">Unblock</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<table class="table table-bordered table-secondary table-striped" id="myTable2">
    <thead>
        <tr>
            <th>User Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($agencies as $agency)
            <tr>
                <td>{{ $agency['user_id'] }}</td>
                <td>{{ $agency['username'] }}</td>
                <td>{{ $agency['email'] }}</td>
                <td>{{ $agency['phone_number'] }}</td>
                <td class="d-flex align-items-center">
                    <a href="{{ route('admin.package', ['user_id' => $agency['user_id']]) }}"
                        class="btn btn-primary mx-2">View Packages</a>
                    @if (is_null($agency['deleted_at']))
                        <form class="block-form" method="post">
                            @method('DELETE')
                            <input type="hidden" name="user_id" value="{{ $agency['user_id'] }}">
                            <button type="submit" class="btn btn-danger block-button">Block</button>
                        </form>
                    @else
                        <form class="unblock-form" method="post">
                            @method('PATCH')
                            <input type="hidden" name="user_id" value="{{ $agency['user_id'] }}">
                            <button type="submit" class="btn btn-success unblock-button">Unblock</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<x-footer></x-footer>
