<x-header></x-header>
   <meta name="csrf-token" content="{{ csrf_token() }}">


<h1 class="text-center">Travel Agencies</h1>
<table class="table table-bordered table-secondary table-striped" id="agenciesTable">

    <thead>
        <tr>
            <th class="text-center">User Id</th>
            <th class="text-center">Username</th>
            <th class="text-center">Agency Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Phone Number</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody class="text-center">
    </tbody>
</table>





<x-footer></x-footer>
<script src="{{ asset('assets/js/admin/agencies.js')  }}"></script>