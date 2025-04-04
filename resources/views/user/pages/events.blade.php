@extends('user.inc.main')

@section('name', 'Pratikshya G')

@section('contents')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="courthero">
    <img src="{{ asset('assets/images/futsal.jpg') }}" alt="Background">
    <h2 class="courthero-h2">Join A Event To Participate</h2>
</div>

<div class="court-container">
    <div class="filter-panel">
        <h3 class="filter-panel-h3">
            Filter Courts
            <i class="fa-solid fa-sliders"></i>
        </h3>
        
        <!-- Location Selection with Checkboxes -->
        <div class="filter-group">
            <label class="filter-title">Past Events</label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="location" value="Ranipauwa"> Ranipauwa</label>
                <label><input type="checkbox" name="location" value="Paiyum"> Paiyum</label>
                <label><input type="checkbox" name="location" value="Bajhapatan"> Bajhapatan</label>
            </div>
        </div>
    
        <!-- Court Selection with Checkboxes -->
        <div class="filter-group">
            <label class="filter-title">Current Events</label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="court" value="Ranipauwa"> Ranipauwa Sports Center</label>
                <label><input type="checkbox" name="court" value="Paiyum"> Paiyum Sports Center</label>
                <label><input type="checkbox" name="court" value="Bajhapatan"> Bajhapatan Sports Center</label>
            </div>
        </div>
    
        <!-- Availability Selection with Checkboxes -->
        <div class="filter-group">
            <label class="filter-title">Upcoming events</label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="availability" value="available"> Available</label>
                <label><input type="checkbox" name="availability" value="booked"> Booked</label>
                <label><input type="checkbox" name="availability" value="unavailable"> Unavailable</label>
            </div>
        </div>
    
        <!-- Time Input -->

    
        <!-- Apply Filters Button with Reset Icon -->
        <div class="button-group">
            <button class="apply-btn">Apply Filters</button>
            <button class="reset-btn" onclick="resetFilters()">
                <i class="fa fa-trash"></i> <!-- Dustbin Icon -->
            </button>
        </div>
    </div>
    
 <div class="content">
    <!-- Search Bar -->
    <div class="search-container">
        <input type="text" class="search-input" placeholder="Find Events">
        <span class="search-icon"><i class="fa fa-search"></i></span>
    </div>

    <!-- Court Cards -->
    <div class="futsal-cards">
        @forelse ($events as $event)
            <div class="futsal-card" onclick="window.location='{{ route('user.eventDetails', $event->id) }}'">
                <img src="{{ asset('storage/uploads/' . $event->image) }}" alt="Event Image" />
                <div class="card-content">
                    <h3>{{ $event->eventName }}</h3>
                    <p class="location">{{ $event->eventLocation }}</p>
                    <div class="ratings">⭐⭐⭐⭐☆</div>
                    <p class="phone">📞 9801234567</p>
                    <p class="price">Rs. {{ $event->eventPrice }}</p>
                </div>
            </div>
        @empty
            <p>No events available.</p>
        @endforelse
    </div>
    
   
</div>

</div>
</body>
</html>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const trigger = document.getElementById("date-time-trigger");
    const form = document.getElementById("date-time-form");

    // Show form below "Pick a date and time"
    trigger.addEventListener("click", function() {
        form.classList.add("show");
        form.style.top = trigger.getBoundingClientRect().bottom + "px"; // Adjust position dynamically
        form.style.left = trigger.getBoundingClientRect().left + "px";
    });

    // Initialize Flatpickr on the date field
    flatpickr("#date-picker", {
        enableTime: true,
        dateFormat: "d M Y",
        disableMobile: true,
    });
});
flatpickr("#time-picker", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });

</script>
<script>
    document.querySelectorAll('.checkbox-group input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            let group = this.name; // Get the name of the group
            document.querySelectorAll(`input[name="${group}"]`).forEach(cb => {
                if (cb !== this) cb.checked = false; // Uncheck others in the same group
            });
        });
    });
    
    function resetFilters() {
        document.querySelectorAll('.checkbox-group input[type="checkbox"]').forEach(cb => cb.checked = false);
        document.getElementById('time-picker').value = '';
    }
</script>

@endsection