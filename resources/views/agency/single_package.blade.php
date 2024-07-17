<!-- resources/views/agency/single_package.blade.php -->

<x-header></x-header>

<div class="container my-5">
    <div class="d-flex border align-items-center gap-4">
        <div>
            <img width="900px"
                 src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/15/33/f5/de/london.jpg?w=1400&h=1400&s=1"
                 alt="Package Image">
        </div>
        <div>
            <h1 class="text-decoration-underline">{{ $package->title }}</h1>
            <p>{{ $package->description }}</p>
        </div>
    </div>

    <div class="border py-4 px-5 mt-5">
        <h3 class="text-decoration-underline">Package Details</h3>
        <p class="fw-bold">Price: ${{ $package->price }}</p>
        <p class="fw-bold">Persons: {{ $package->persons }}</p>
        <p class="fw-bold">Start Date: {{ $package->start_date }}</p>
        <p class="fw-bold">End Date: {{ $package->end_date }}</p>

        <h3 class="text-decoration-underline mt-4">Services</h3>
        <ul>
            @foreach ($package->services as $service)
                <li class="fw-bold">
                           {{ $service->service}}
                </li>
            @endforeach
        </ul>

        <h3 class="text-decoration-underline mt-4">Destinations</h3>
        <ul>
            @foreach ($package->destinations as $destination)
                <li class="fw-bold">
                  {{ $destination->destination }}
                </li>
            @endforeach
        </ul>

        <div class="d-flex align-items-center mt-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Update
                Package</button>
                   <form method="POST" action="{{ route('package.destroy', $package->vp_id) }}" id="deletePackageForm" class="ms-2">
                @csrf
                @method('DELETE')
                <input type="hidden" name="vp_id" value="{{ $package->vp_id }}">
                <button type="submit" id="deletePackageButton" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>

<x-footer></x-footer>

{{-- MODEL --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Package</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updatePackageForm"  action="{{ route('agency.packages.update', $package->vp_id) }}" method="POST">
                    @csrf
                    @method('PUT')
               <div id="errorContainer" class="alert alert-danger pt-3" style="display: none;">
                        <ul></ul>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $package->title) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea type="text" name="description" rows="5" class="form-control">{{ old('description', $package->description) }}</textarea>
                    </div>
                    <div>
                      <label for="">Services</label>
                        <select name="services[]" class="form-select" multiple>
                            @foreach ($allServices as $service)
                                <option value="{{ $service->service_id }}">{{ $service->service }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Destinations</label>
                        <select name="destinations[]" class="form-select" multiple>
                            @foreach ($allDestinations as $destination)
                                <option value="{{ $destination->destination_id }}">{{ $destination->destination }}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Persons</label>
                        <input type="number" name="persons" class="form-control" value="{{ old('persons', $package->persons) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $package->price) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $package->start_date) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $package->end_date) }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Package</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/agency/package.js') }}"></script>