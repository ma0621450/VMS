<x-header></x-header>
<div class="m-4">
    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal">
        Create Packages
    </button>
</div>
<div class="packages-cards d-flex flex-wrap justify-content-center">
    @foreach ($vp as $package)

             <div class="m-4 rounded border border-muted border-2" style="width: 22rem;">
            <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/15/33/f5/de/london.jpg?w=1400&h=1400&s=1"
                class="card-img-top" alt="...">
            <div class="card-body p-2">
                <a href="{{ route('package.edit', $package->vp_id) }}" class="card-link">
                    <h5 class="card-title text-decoration-underline"><?php echo $package['title']; ?></h5>
                </a>
                <h6 class="card-text limited-description"><?php echo $package['description']; ?></p>
                <h6 class="text-secondary">Price: $<?php echo $package['price']; ?></p>
                    <h6 class="text-secondary">Date: {{   $package['start_date']}} - {{  $package['end_date']}}</h6>
            </div>
        </div>
    @endforeach
</div>



<div class="modal fade @if ($errors->any()) show @endif" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="@if (!$errors->any()) true @else false @endif" style="@if ($errors->any()) display: block; @endif">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Package</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('agency.packages.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea type="text" name="description" class="form-control">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Services</label>
                        <select name="services[]" class="form-select" multiple>
                            @foreach ($services as $service)
                                <option value="{{ $service->service_id }}">{{ $service->service }}</option>
                            @endforeach
                        </select>
                        @error('services')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Destinations</label>
                        <select name="destinations[]" class="form-select" multiple>
                            @foreach ($destinations as $destination)
                                <option value="{{ $destination->destination_id }}">{{ $destination->destination }}</option>
                            @endforeach 
                        </select>
                        @error('destinations')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Persons</label>
                        <input type="number" name="persons" class="form-control" value="{{ old('persons') }}">
                        @error('persons')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
                        @error('start_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
                        @error('end_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create Package</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
<x-footer></x-footer>