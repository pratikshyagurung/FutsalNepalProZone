@extends('futsal_owner.inc.main')
@section('container')

<div class="form-container">
    <h2>Create Event</h2>
    <p>Fill out the form below to add event at your futsal court to our system.</p>

    <form id="createEventForm" method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
        @csrf {{-- Laravel CSRF Protection --}}

        <div class="form-group">
            <label for="eventName">Event Name</label>
            <input type="text" id="eventName" name="eventName" placeholder="Enter event name" required />
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" id="location" name="eventLocation" placeholder="Enter location" required />
        </div>

        <div class="form-group">
            <label for="eventMap">Court Location (Google Maps Link)</label>
            <input type="url" name="eventMap" id="eventMap" class="form-control" placeholder="Enter Google Maps link" required>
        </div>
        


        <div class="form-group">
            <label for="price">Price per Hour (NPR)</label>
            <input type="number" id="price" name="eventPrice" placeholder="Enter price" required />
        </div>


        <div class="form-group">
            <label for="eventService">Service Availability</label>
            <label for="water">
                <input type="checkbox" id="water" name="eventService[]" value="Water" class="serviceAvailability"> Water
            </label>
            <label for="changing-rooms">
                <input type="checkbox" id="changing-rooms" name="eventService[]" value="Changing Rooms" class="serviceAvailability"> Changing Rooms
            </label>
            <label for="parking">
                <input type="checkbox" id="parking" name="eventService[]" value="Parking" class="serviceAvailability"> Parking
            </label>
            <label for="wifi">
                <input type="checkbox" id="wifi" name="eventService[]" value="Wifi" class="serviceAvailability"> Wifi
            </label>
            <label for="all">
                <input type="checkbox" id="all" name="eventService[]" value="All" class="serviceAvailability"> All
            </label>
            
            @error('eventService')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="eventDescription" placeholder="This event is to ....." required />
        </div>

        <div class="form-group">
            <label for="eventImage">Upload Event Image</label>
            <input type="file" id="eventImage" name="eventImage" accept="image/*" />
            @error('eventImage')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Create Event</button>
    </form>
</div>

<script>
    // Function to toggle 'All' checkbox based on other checkboxes
    const checkboxes = document.querySelectorAll('input[name="eventService[]"]:not(#all)');

    document.getElementById('all').addEventListener('change', function() {
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            document.getElementById('all').checked = [...checkboxes].every(c => c.checked);
        });
    });
</script>

@endsection