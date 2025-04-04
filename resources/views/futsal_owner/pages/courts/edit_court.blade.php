@extends('futsal_owner.inc.main')
@section('container')
    <div class="form-container">
        <h2>Edit Your Futsal Court</h2>
        <a href="{{ route('courts.index') }}" class="btn btn-primary my-3">Back</a>

        <legend> Form </legend>
        <form action="{{ route('courts.update', $court->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="courtName">Court Name</label>
                <input type="text" id="courtName" name="courtName" placeholder="Enter court name"
                    value="{{ old('courtName', $court->courtName) }}" required />
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="courtLocation" placeholder="Enter location"
                    value="{{ old('courtLocation', $court->courtLocation) }}" required />
            </div>

            <div class="form-group">
                <label for="courtMap">Court Location (Google Maps Link)</label>
                <input type="url" name="courtMap" id="courtMap" class="form-control" placeholder="Enter Google Maps link"
                    value="{{ old('courtMap', $court->courtMap) }}" required />
            </div>

            <div class="form-group">
                <label for="price">Price per Hour (NPR)</label>
                <input type="number" id="price" name="courtPrice" placeholder="Enter price"
                    value="{{ old('courtPrice', $court->courtPrice) }}" required />
            </div>

            <div class="form-group">
                <label for="availability">Availability</label>
                <select id="availability" name="courtAvailability" required>
                    <option value="available" {{ old('courtAvailability', $court->courtAvailability) == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="unavailable" {{ old('courtAvailability', $court->courtAvailability) == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                </select>
            </div>

            <div class="form-group">
                <label for="courtService">Service Availability</label>
                @php
                    $selectedServices = json_decode($court->courtService, true) ?? [];
                @endphp
                <label>
                    <input type="checkbox" name="courtService[]" value="Water" class="serviceAvailability"
                        {{ in_array("Water", $selectedServices) ? 'checked' : '' }}> Water
                </label>
                <label>
                    <input type="checkbox" name="courtService[]" value="Changing Rooms" class="serviceAvailability"
                        {{ in_array("Changing Rooms", $selectedServices) ? 'checked' : '' }}> Changing Rooms
                </label>
                <label>
                    <input type="checkbox" name="courtService[]" value="Parking" class="serviceAvailability"
                        {{ in_array("Parking", $selectedServices) ? 'checked' : '' }}> Parking
                </label>
                <label>
                    <input type="checkbox" name="courtService[]" value="Wifi" class="serviceAvailability"
                        {{ in_array("Wifi", $selectedServices) ? 'checked' : '' }}> Wifi
                </label>
                <label>
                    <input type="checkbox" id="all" name="courtService[]" value="All" class="serviceAvailability"
                        {{ in_array("All", $selectedServices) ? 'checked' : '' }}> All
                </label>
                @error('courtService')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="courtDescription" placeholder="Enter description"
                    value="{{ old('courtDescription', $court->courtDescription) }}" required />
            </div>

            <div class="form-group">
                <label for="courtImage">Upload Court Image</label>
                @if($court->image)
                    <div>
                        <img src="{{ asset('storage/uploads/' . $court->image) }}" alt="Current Court Image" width="100" height="100">
                    </div>
                @endif
                <input type="file" id="courtImage" name="courtImage" accept="image/*" />
                @error('courtImage')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Update Court</button>
        </form>
        {{-- @if(auth()->user()->notifications->count())
    <ul>
        @foreach(auth()->user()->notifications as $notification)
            <li>
                {{ $notification->data['message'] }}
                <a href="{{ route('notifications.read', $notification->id) }}">Mark as Read</a>
            </li>
        @endforeach
    </ul>
@endif --}}

    </div>

    <script>
        // Auto-toggle 'All' checkbox based on other checkboxes
        const checkboxes = document.querySelectorAll('input[name="courtService[]"]:not(#all)');
        const allCheckbox = document.getElementById('all');

        allCheckbox.addEventListener('change', function() {
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                allCheckbox.checked = [...checkboxes].every(c => c.checked);
            });
        });
    </script>
@endsection
