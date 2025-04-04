@extends('futsal_owner.inc.main')
@section('container')

@if (Session::has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="table-container">
    <a href="{{ route('courts.create') }}" class="add-btn">Add</a>

    <table class="table table-secondary table-hover table-bordered table-sm table-responsive-sm">
        <thead>
            <tr>
                <th scope="col">S.N</th>
                <th scope="col">Court Name</th>
                <th scope="col">Location</th>
                <th scope="col">Court Map Links</th>
                <th scope="col">Price per Hour (NPR)</th>
                <th scope="col">Availability</th>
                <th scope="col">Services Available</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courts as $court)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $court->courtName }}</td>
                    <td>{{ $court->courtLocation }}</td>
                    
                    <!-- Court map link which we will use to extract coordinates -->
                    <td>
                        {{-- @if($court->courtMap)
                            @php
                                $mapUrl = $court->courtMap;
                                // Ensure URL starts with https://
                                if (!preg_match('/^https?:\/\//i', $mapUrl)) {
                                    $mapUrl = 'https://' . $mapUrl;
                                }
                            @endphp
                            <a href="javascript:void(0)" class="map-link" 
                               data-map="{{ $mapUrl }}" 
                               data-id="{{ $court->id }}">
                                View on Map
                            </a>
                            <div class="map-url" style="display: none;">{{ $mapUrl }}</div>
                        @else
                            N/A
                        @endif --}}
                        <a href="{{ $court->courtMap }}" target="_blank">View on map</a>
                    </td>

                    <td>{{ $court->courtPrice }}</td>
                    <td>{{ $court->courtAvailability }}</td>
                    <td>
                        @if($court->courtService)
                            @php
                                $services = json_decode($court->courtService, true);
                                if (in_array('All', $services)) {
                                    $services = ['Water', 'Changing Rooms', 'Parking', 'Wifi'];
                                }
                            @endphp
                            @foreach($services as $service)
                                <span>{{ $service }}</span><br>
                            @endforeach
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $court->courtDescription }}</td>
                    <td>
                        <a target="_blank" href="{{ asset('storage/uploads/' . $court->courtImage) }}">
                            <img src="{{ asset('storage/uploads/' . $court->image) }}" alt="Court Image" width="100px" height="100px">
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('courts.edit', $court->id) }}" class="btn btn-primary btn-sm">Edit</a>

                        <!-- Delete Button to Open Modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $court->id }}">
                            Delete
                        </button>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteModal{{ $court->id }}" tabindex="-1"
                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content text-center">
                                    <!-- Header -->
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title fw-bold">⚠ Court Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <!-- Body -->
                                    <div class="modal-body">
                                        <p class="fs-5">Are you sure you want to delete this court? </p>
                                    </div>

                                    <!-- Footer -->
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button type="button" class="btn btn-secondary px-4"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('courts.destroy', $court->id) }}" method="POST">
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

<!-- Map container -->
<div id="map-container" style="display: none; margin: 20px auto; max-width: 1200px;">
    <h2 id="map-title" style="font-size: 24px; font-weight: bold; color: #2c3e50; text-align: center; margin-bottom: 15px;"></h2>
    <div id="map" style="height: 600px; width: 100%; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);"></div>
    <div id="map-link-container" style="margin-top: 10px; padding: 10px; background: #f8f9fa; border-radius: 5px;">
        <strong>Google Maps Link:</strong>
        <a id="map-link" href="#" target="_blank" style="word-break: break-all;"></a>
    </div>
    <button id="close-map" style="margin-top: 15px; padding: 8px 20px; background: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer;">Close Map</button>
</div>

<!-- Load jQuery first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Then load Google Maps API with your actual key -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_ACTUAL_API_KEY&callback=initMap" async defer></script>

<script>
let map;
let marker;
let geocoder;

function initMap() {
    // Create a basic map instance
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 27.7172, lng: 85.3240 }, // Default center (Kathmandu)
        zoom: 12
    });
    
    geocoder = new google.maps.Geocoder();
    
    // Set up click handlers after map loads
    setupMapHandlers();
}

function setupMapHandlers() {
    // Handle "View on Map" clicks
    $(document).on('click', '.map-link', function(e) {
        e.preventDefault();
        let mapUrl = $(this).data('map');
        const courtName = $(this).closest('tr').find('td:first').text();
        
        // Show loading state
        $('#map-title').text(courtName + " Location");
        $('#map-container').show();
        $('#map').html('<div style="height:100%; display:flex; justify-content:center; align-items:center;">Loading map...</div>');
        
        // Ensure URL is properly formatted
        if (!mapUrl.startsWith('http')) {
            mapUrl = 'https://' + mapUrl;
        }
        
        // Process the URL to show the specific location
        processMapUrl(mapUrl, courtName);
        
        // Scroll to map
        $('html, body').animate({
            scrollTop: $('#map-container').offset().top
        }, 500);
    });
    
    // Close map button
    $('#close-map').click(function() {
        $('#map-container').hide();
        if (marker) marker.setMap(null);
    });
}

function processMapUrl(url, courtName) {
    // First try to extract coordinates from URL
    const coords = extractCoordinatesFromUrl(url);
    
    if (coords) {
        // We have coordinates - show the map
        showLocationOnMap(coords, courtName, url);
    } else {
        // No coordinates found - try to geocode the URL
        geocodeMapUrl(url, courtName);
    }
}

function extractCoordinatesFromUrl(url) {
    // Handle different URL formats
    
    // 1. Standard Google Maps URL with @coordinates
    // Example: https://www.google.com/maps/@27.7172,85.3240,15z
    const coordMatch1 = url.match(/@(-?\d+\.\d+),(-?\d+\.\d+)/);
    if (coordMatch1) {
        return {
            lat: parseFloat(coordMatch1[1]),
            lng: parseFloat(coordMatch1[2])
        };
    }
    
    // 2. Google Maps place URL with coordinates
    // Example: https://www.google.com/maps/place/Payum+Sports+Center/@27.7172,85.3240,15z
    const coordMatch2 = url.match(/place\/[^@]+@(-?\d+\.\d+),(-?\d+\.\d+)/);
    if (coordMatch2) {
        return {
            lat: parseFloat(coordMatch2[1]),
            lng: parseFloat(coordMatch2[2])
        };
    }
    
    // 3. Google Maps URL with query parameters
    // Example: https://www.google.com/maps?q=27.7172,85.3240
    const coordMatch3 = url.match(/[?&]q=(-?\d+\.\d+),(-?\d+\.\d+)/);
    if (coordMatch3) {
        return {
            lat: parseFloat(coordMatch3[1]),
            lng: parseFloat(coordMatch3[2])
        };
    }
    
    return null; // If no coordinates found
}

function geocodeMapUrl(url, courtName) {
    // Try to extract address from URL
    let address = '';
    
    // For place URLs: https://www.google.com/maps/place/Payum+Sports+Center
    const placeMatch = url.match(/place\/([^/@]+)/);
    if (placeMatch) {
        address = decodeURIComponent(placeMatch[1].replace(/\+/g, ' '));
    }
    
    // For search URLs: https://www.google.com/maps?q=Payum+Sports+Center
    const searchMatch = url.match(/[?&]q=([^&]+)/);
    if (searchMatch && !address) {
        address = decodeURIComponent(searchMatch[1].replace(/\+/g, ' '));
    }
    
    if (address) {
        // Try geocoding the address
        geocoder.geocode({ 'address': address }, function(results, status) {
            if (status === 'OK') {
                showLocationOnMap(results[0].geometry.location, courtName, url);
            } else {
                showMapError("Could not determine location from this link. Please use a standard Google Maps share link with coordinates.", url);
            }
        });
    } else {
        showMapError("Invalid Google Maps URL format. Please use a standard share link.", url);
    }
}

function showLocationOnMap(coords, courtName, url) {
    // Center map on these coordinates
    map.setCenter(coords);
    map.setZoom(16); // Zoom in closer
    
    // Remove existing marker if any
    if (marker) marker.setMap(null);
    
    // Add new marker with animation
    marker = new google.maps.Marker({
        position: coords,
        map: map,
        title: courtName,
        animation: google.maps.Animation.DROP
    });
    
    // Show the original link
    $('#map-link').attr('href', url).text(url);
    $('#map-link-container').show();
}

function showMapError(message, url) {
    $('#map').html(`
        <div style="height:100%; display:flex; flex-direction:column; justify-content:center; align-items:center;">
            <div class="alert alert-danger">
                ${message}<br>
                <small>URL: ${url}</small>
            </div>
            <div style="margin-top: 15px;">
                <a href="${url}" target="_blank" class="btn btn-primary">Open link in new tab</a>
            </div>
        </div>
    `);
    $('#map-link-container').hide();
}
</script>
@endsection