{{-- <p><strong>Location: </strong><a href="{{ $event->eventMap }}" target="_blank">View on Google Maps</a></p> --}}
@extends('futsal_owner.inc.main')
@section('container')
    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-container">
        <a href="{{ route('events.create') }}" class="add-btn">Add</a>
        {{-- <div id="map"></div>
        <button onclick="showMap(25.594095, 85.137566)">Show Map</button> --}}


        <table class="table table-secondary table-hover table-bordered table-sm table-responsive-sm">
            <thead>
                <tr>
                    <th scope="col">S.N</th>
                    <th scope="col">Event Name</th>
                    <th scope="col">Location</th>
                    <th scope="col">Court Location (Google Maps Link)</th>
                    <th scope="col">Price per Hour (NPR)</th>
                    <th scope="col">Services Available</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $event->eventName }}</td>
                        <td>{{ $event->eventLocation }}</td>
                        <td>{{ $event->eventMap }}</td>
                        <td>{{ $event->eventPrice }}</td>
                        <td>
                            @php
                                $services = json_decode($event->eventService, true) ?? [];
                                
                                // Ensure $services is an array before checking in_array
                                if (is_array($services) && in_array('All', $services)) {
                                    $services = ['Water', 'Changing Rooms', 'Parking', 'Wifi'];
                                }
                            @endphp
                        
                            @if (!empty($services))
                                @foreach ($services as $service)
                                    <span>{{ $service }}</span><br>
                                @endforeach
                            @else
                                N/A
                            @endif
                        </td>
                        
                        <td>{{ $event->eventDescription }}</td>
                        <td>
                            <a target="_blank" href="{{ asset('storage/uploads/' . $event->eventImage) }}">
                                <img src="{{ asset('storage/uploads/' . $event->image) }}" alt="Event Image" width="100px" height="100px">
                            </a>
                        </td>
                        
                        <td>
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-primary btn-sm">Edit</a>

                            <!-- Delete Button to Open Modal -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $event->id }}">
                                Delete
                            </button>

                            <!-- Delete Confirmation Modal -->
                            <div class="modal fade" id="deleteModal{{ $event->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content text-center">
                                        <!-- Header -->
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title fw-bold">⚠ Event Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <!-- Body -->
                                        <div class="modal-body">
                                            <p class="fs-5">Are you sure you want to delete this event? </p>
                                        </div>

                                        <!-- Footer -->
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="button" class="btn btn-secondary px-4"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger px-4 fw-bold">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <br>
    {{-- google map html --}}
    <style>
/* Center align the map section */
#map-container {
    text-align: center;
    margin: 20px auto;
    max-width: 1200px;
    display: block; /* Ensures heading and map are stacked */
}

/* Style the heading */
h2 {
    font-size: 24px;
    font-weight: bold;
    color: #2c3e50;
    text-align: center;
    margin-bottom: 10px;
    display: block; /* Force it to take full width */
    width: 100%; /* Ensures it doesn't shrink */
}

/* Improve map appearance */
#map {
    width: 100%; /* Makes the map responsive */
    display: block; /* Ensures stacking */
}

#map iframe {
    width: 80%; /* Adjust for better alignment */
    height: 500px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

    </style>    
<div id="map-container">
    <h2>Google Map</h2>
    <div id="map">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d14063.020610280777!2d83.98944816050232!3d28.21475066611528!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sfutsal%20court!5e0!3m2!1sen!2snp!4v1741327479068!5m2!1sen!2snp" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

    
    
@endsection
