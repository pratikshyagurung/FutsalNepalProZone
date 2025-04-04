@extends('futsal_owner.inc.main')

@section('container')
    <div class="form-container">
        <h2>Create Your Futsal Court</h2>
        <p>Fill out the form below to add your futsal court to our system.</p>

        <form id="createCourtForm" method="POST" action="{{ route('courts.store') }}" enctype="multipart/form-data">
            @csrf {{-- Laravel CSRF Protection --}}

            <div class="form-group">
                <label for="courtName">Court Name</label>
                <input type="text" id="courtName" name="courtName" placeholder="Enter court name" required />
                @error('courtName')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="courtLocation">Location</label>
                <input type="text" id="courtLocation" name="courtLocation" placeholder="Enter location" required />
                @error('courtLocation')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            {{-- <div class="form-group">
                <label for="courtMap">Court Location (Google Maps Link)</label>
                <input type="url" name="courtMap" id="courtMap" class="form-control" placeholder="Enter Google Maps link" required>
            </div> --}}
            <div class="form-group">
                <label for="courtMap">Court Location (Google Maps Link)</label>
                <input 
                type="url" 
                name="courtMap" 
                id="courtMap" 
                class="form-control" 
                placeholder="Paste Google Maps SHARE link (https://maps.app.goo.gl/...)" 
                required
            >
                <small class="text-muted">
                    Go to <a href="https://maps.google.com" target="_blank">Google Maps</a>, find your location, 
                    click "Share", then copy and paste the link here.
                </small>

                @error('courtMap')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="form-group">
                <label for="courtPrice">Price per Hour (NPR)</label>
                <input type="number" id="courtPrice" name="courtPrice" placeholder="Enter price" required />
                @error('courtPrice')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

                <div class="form-group">
                <label for="availability">Availability</label>
                <select id="availability" name="courtAvailability" required>
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>
            </div>

            <div class="form-group">
                <label for="courtService">Service Availability</label>
                <label for="water">
                    <input type="checkbox" id="water" name="courtService[]" value="Water" class="serviceAvailability"> Water
                </label>
                <label for="changing-rooms">
                    <input type="checkbox" id="changing-rooms" name="courtService[]" value="Changing Rooms" class="serviceAvailability"> Changing Rooms
                </label>
                <label for="parking">
                    <input type="checkbox" id="parking" name="courtService[]" value="Parking" class="serviceAvailability"> Parking
                </label>
                <label for="wifi">
                    <input type="checkbox" id="wifi" name="courtService[]" value="Wifi" class="serviceAvailability"> Wifi
                </label>
                <label for="all">
                    <input type="checkbox" id="all" name="courtService[]" value="All" class="serviceAvailability"> All
                </label>
                
                @error('courtService')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="courtDescription">Description</label>
                <input type="text" id="courtDescription" name="courtDescription" placeholder="Enter description" />
                @error('courtDescription')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="courtImage">Upload Court Image</label>
                <input type="file" id="courtImage" name="courtImage" accept="image/*" />
                @error('courtImage')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        

            {{-- <input type="text" id="latitude" name="latitude">
            <input type="text" id="longitude" name="longitude"> --}}

            <button type="submit">Create Court</button>
        </form> 
    </div>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places"></script> --}}

    <script>

        // $(document).ready(function () {
        //     var input = document.getElementById('courtLocation');
        //     var autocomplete = new google.maps.places.Autocomplete(input, {
        //         types: ['geocode'],
        //     });

        //     autocomplete.addListener('place_changed', function () {
        //         var nearPlace = autocomplete.getPlace();
        //         if (nearPlace.geometry) {
        //             $("#latitude").val(nearPlace.geometry.location.lat());
        //             $("#longitude").val(nearPlace.geometry.location.lng());
        //         }
        //     });
        // });

        // Function to toggle 'All' checkbox based on other checkboxes
document.getElementById("courtMap").addEventListener("input", function() {
    const mapLink = this.value;
    const mapPreview = document.getElementById("mapPreview");
    
    // Convert the new Google Maps link to an embeddable format
    if (mapLink.includes("maps.app.goo.gl")) {
        // First, we need to follow the short link to get the real URL
        fetch(`https://api.allorigins.win/get?url=${encodeURIComponent(mapLink)}`)
            .then(response => response.json())
            .then(data => {
                const realUrl = data.contents.match(/https:\/\/www\.google\.com\/maps\/[^"]+/)[0];
                const embedUrl = realUrl.replace('/place/', '/embed?pb=!1m18!1m12!1m3!');
                mapPreview.innerHTML = `<iframe src="${embedUrl}" width="100%" height="100%" style="border:0;"></iframe>`;
            })
            .catch(error => {
                mapPreview.innerHTML = "<p class='text-danger'>Couldn't load map. Please check the link.</p>";
            });
    }
});
    </script>
@endsection
