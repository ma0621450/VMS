<x-header></x-header>
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-3">
            <select id="sortPrice" class="form-control">
                <option value="">Sort by Price</option>
                <option value="asc">Low to High</option>
                <option value="desc">High to Low</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="date" id="startDate" class="form-control" placeholder="Start Date">
        </div>
        <div class="col-md-2">
            <input type="date" id="endDate" class="form-control" placeholder="End Date">
        </div>
        <div class="col-md-2">
            <button id="filterDate" class="btn btn-primary">Filter</button>
        </div>
        <div class="col-md-3">
            <input type="text" id="searchTitle" class="form-control" placeholder="Search by Title">
        </div>
    </div>
</div>

<div class="packages-cards d-flex flex-wrap justify-content-center text-center" id="packagesContainer">
    @foreach ($vp as $package)
        <div class="m-4 border rounded border-muted package-card" data-price="{{ $package->price }}"
            data-start-date="{{ $package->start_date }}" data-end-date="{{ $package->end_date }}"
            style="width: 25rem;">
            <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/15/33/f5/de/london.jpg?w=1400&h=1400&s=1"
                class="card-img-top" alt="...">
            <div class="card-body p-2">
                <h5 class="card-title">{{ $package->title }}</h5>
                <p class="card-text limited-description">{{ $package->description }}</p>
                <h6>Price: ${{ $package->price }}</h6>
                <div class="fw-bold text-center mb-3">
                    <span>From {{ $package->start_date }}</span> - {{ $package->end_date }}<span></span>
                </div>
                <a href="{{route('package.show', $package->vp_id)}}" type="button" class="btn btn-primary">
                    View More Details
                </a>
            </div>
        </div>
    @endforeach
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3"> Services </h6>
            <h1 class="mb-5">Our Services</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item rounded pt-3">
                    <div class="p-4"> <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                        <h5>WorldWide Tours</h5>
                        <p> Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item rounded pt-3">
                    <div class="p-4"> <i class="fa fa-3x fa-hotel text-primary mb-4"></i>
                        <h5>Hotel Reservation</h5>
                        <p> Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded pt-3">
                    <div class="p-4"> <i class="fa fa-3x fa-user text-primary mb-4"></i>
                        <h5>Travel Guides</h5>
                        <p> Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="service-item rounded pt-3">
                    <div class="p-4"> <i class="fa fa-3x fa-cog text-primary mb-4"></i>
                        <h5>Event Management</h5>
                        <p> Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item rounded pt-3">
                    <div class="p-4"> <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                        <h5>WorldWide Tours</h5>
                        <p> Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item rounded pt-3">
                    <div class="p-4"> <i class="fa fa-3x fa-hotel text-primary mb-4"></i>
                        <h5>Hotel Reservation</h5>
                        <p> Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded pt-3">
                    <div class="p-4"> <i class="fa fa-3x fa-user text-primary mb-4"></i>
                        <h5>Travel Guides</h5>
                        <p> Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="service-item rounded pt-3">
                    <div class="p-4"> <i class="fa fa-3x fa-cog text-primary mb-4"></i>
                        <h5>Event Management</h5>
                        <p> Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-footer></x-footer>

{{-- <script src="public/js/customer/home.js"></script>  --}}