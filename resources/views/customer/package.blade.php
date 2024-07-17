<x-header></x-header>
<div class="container">
    <div class="d-flex border rounded-4 align-items-center" style="gap: 20px;">
        <div>
            <img width="900px"
                src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/15/33/f5/de/london.jpg?w=1400&h=1400&s=1"
                class="" alt="Package Image">
        </div>
        <div class="">
            <h1 class="text-decoration-underline">{{ $package->title }}</h1>
            <p class=" ">{{ $package->description }}</p>

        </div>
    </div>
    <?php if ($package): ?>
        <div style="width: 870px; margin-top: 40px;">
            <h2 style="margin-left: 10px;" class="text-decoration-underline">About Travel Agency</h2>
            <div class="border rounded-4 p-3">
                <h5>{{  $travel_agency->travel_agency_name }}</h5>
                <p>{{  $travel_agency->travel_agency_description }}</p>
            </div>
        </div>
    <?php endif ?>
    <h2 style="margin-left: 30px;" class="mt-5 text-decoration-underline">Reviews</h2>
    <div class="d-flex">
        <div style="width: 250px;height: 300px;"
            class="m-4 p-3  border border-2 rounded-4 border-muted d-flex flex-column align-items-center text-center ">
            <img width="160px"
                src="https://t3.ftcdn.net/jpg/02/43/12/34/360_F_243123463_zTooub557xEWABDLk0jJklDyLSGl2jrr.jpg"
                class="rounded-circle border" alt="...">
            <div class="card-body p-2">
                <h3>John Smith</h3>
                <p class="card-text fw-bold">Lorem ipsum tempore optio recusandae
                    itaque natus.Lorem ipsum tempore optio recusandae
                    itaque natus.</p>
            </div>
        </div>
        <div style="width: 250px;height: 300px;"
            class="m-4 p-3  border border-2 rounded-4 border-muted d-flex flex-column align-items-center text-center ">
            <img width="160px"
                src="https://t3.ftcdn.net/jpg/02/43/12/34/360_F_243123463_zTooub557xEWABDLk0jJklDyLSGl2jrr.jpg"
                class="rounded-circle border" alt="...">
            <div class="card-body p-2">
                <h3>John Smith</h3>
                <p class="card-text fw-bold">Lorem ipsum tempore optio recusandae
                    itaque natus.Lorem ipsum tempore optio recusandae
                    itaque natus.</p>
            </div>
        </div>
        <div style="width: 250px;height: 300px;"
            class="m-4 p-3 border border-2 rounded-4 border-muted d-flex flex-column align-items-center text-center ">
            <img width="160px"
                src="https://t3.ftcdn.net/jpg/02/43/12/34/360_F_243123463_zTooub557xEWABDLk0jJklDyLSGl2jrr.jpg"
                class="rounded-circle border" alt="...">
            <div class="card-body p-2">
                <h3>John Smith</h3>
                <p class="card-text fw-bold">Lorem ipsum tempore optio recusandae
                    itaque natus.Lorem ipsum tempore optio recusandae
                    itaque natus.</p>
            </div>
        </div>
        <div style="margin-top: -250px;">
            <div class="border rounded-4 py-5 px-4 mx-5">
                <h3 class="text-decoration-underline">Package Details</h3>
                <p class="fw-bold">Price: $<?php echo $package['price']; ?></p>
                <p class="fw-bold">Start Date: <?php echo $package['start_date']; ?></p>
                <p class="fw-bold">End Date: <?php echo $package['end_date']; ?></p>





                <h3 class="text-decoration-underline">Destinations</h3>
                @foreach ($destinations as $destination)
                <ul>
                      <li>

                          {{ $destination->destination }}
                      </li>
                    </ul>
                    @endforeach
                <h3 class="text-decoration-underline">Services</h3>
 @foreach ($services as $service)
                <ul>
                    <li>
                        {{ $service->service }}
                        </li> 
                    </ul>
                    @endforeach
                </li>
                </ul>

                <div class="d-flex align-items-center">

                    @if ($booking)
        <button type="button" class="btn btn-primary" disabled>Booked</button>
    @else
        <form action="{{ route('package.book', $package->vp_id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">BOOK NOW</button>
        </form>
    @endif
                    <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Inquiry
                    </button>
                </div>
            </div>

        </div>
    </div>

</div>


<x-footer></x-footer>

<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Inquiry</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="inquiryForm" action="{{ route('user.inquiry.create', $package->vp_id) }}" method="POST">
    @csrf
<div id="errorContainer" class="alert alert-danger" style="display: none;"></div>

    <div class="mb-3">
        <label for="subject" class="form-label">Subject:</label>
        <input type="text" id="subject" name="subject" class="form-control">
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Message:</label>
        <textarea id="message" name="message" rows="5" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit Inquiry</button>
</form>

            </div>
        </div>
    </div>
</div>


<script src="{{ asset(  'assets/js/customer/package.js') }}"></script>