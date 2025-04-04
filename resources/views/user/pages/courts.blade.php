@extends('user.inc.main')
@section('name', 'PratikshyaG')
@section('contents')
<!-- Include Flatpickr CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="courthero">
    <img src="{{ asset('assets/images/futsal.jpg') }}" alt="Background">
    <h2 class="courthero-h2">Book A Court To Play</h2>

    <div class="search-box">
        <div class="input-group">
            <label>Court</label>
            <select>
                <option>Select a court</option>
                <option>Ranipauwa</option>
                <option>Paiyum</option>
                <option>Bajhapatan</option>
            </select>
        </div>
        <div class="input-group">
            <label>Where</label>
            <input type="text" placeholder="Search venue name, city, or state">
        </div>

        <!-- Date Picker Trigger -->
        <div class="input-group">
            <label>When</label>
            <input type="text" id="date-time-trigger" placeholder="Pick a date and time">
        </div>

        <button class="search-btn"><i class="fa fa-search"></i>  Search</button>
    </div>

    <!-- Move Date-Time Form Here (Outside .search-box) -->
    <div id="date-time-form" class="date-time-form">
        <div class="input-group">
            <label>Date</label>
            <input type="date" id="date-picker" placeholder="Select Date">
        </div>

        <div class="input-group">
            <label>Start Time & Duration</label>
            <div class="time-duration">
                <select id="start-time">
                    <option>00:00</option>
                    <option>01:00</option>
                    <option>02:00</option>
                    <option>03:00</option>
                    <option>04:00</option>
                    <option>05:00</option>
                    <option>06:00</option>
                    <option>07:00</option>
                    <option>08:00</option>
                    <option>09:00</option>
                    <option>10:00</option>
                    <option>11:00</option>
                    <option>12:00</option>
                </select>

                <select id="am-pm">
                    <option>AM</option>
                    <option>PM</option>
                </select>

                <select id="duration">
                    <option>1 Hour</option>
                    <option>2 Hours</option>
                    <option>3 Hours</option>
                </select>
            </div>
        </div>
        <form>
            <button type="submit">Done</button>
        </form>
    </div>
</div>

<div class="court-container">

<div class="filter-panel">
    <h3 class="filter-panel-h3">
        Filter Courts
        <i class="fa-solid fa-sliders"></i>
    </h3>
    
    <!-- Location Selection with Checkboxes -->
    <div class="filter-group">
        <label class="filter-title">Location</label>
        <div class="checkbox-group">
            <label><input type="checkbox" name="location" value="Ranipauwa"> Ranipauwa</label>
            <label><input type="checkbox" name="location" value="Paiyum"> Paiyum</label>
            <label><input type="checkbox" name="location" value="Bajhapatan"> Bajhapatan</label>
        </div>
    </div>

    <!-- Court Selection with Checkboxes -->
    <div class="filter-group">
        <label class="filter-title">Court</label>
        <div class="checkbox-group">
            <label><input type="checkbox" name="court" value="Ranipauwa"> Ranipauwa Sports Center</label>
            <label><input type="checkbox" name="court" value="Paiyum"> Paiyum Sports Center</label>
            <label><input type="checkbox" name="court" value="Bajhapatan"> Bajhapatan Sports Center</label>
        </div>
    </div>

    <!-- Availability Selection with Checkboxes -->
    <div class="filter-group">
        <label class="filter-title">Availability</label>
        <div class="checkbox-group">
            <label><input type="checkbox" name="availability" value="available"> Available</label>
            <label><input type="checkbox" name="availability" value="booked"> Booked</label>
            <label><input type="checkbox" name="availability" value="unavailable"> Unavailable</label>
        </div>
    </div>

    <!-- Time Input -->
    <div class="filter-group">
        <label class="filter-title">Time</label>
        <input type="text" id="time-picker" placeholder="Select time">
    </div>

    <!-- Apply Filters Button with Reset Icon -->
    <div class="button-group">
        <button class="apply-btn">Apply Filters</button>
        <button class="reset-btn" onclick="resetFilters()">
            <i class="fa fa-trash"></i> <!-- Dustbin Icon -->
        </button>
    </div>
</div>

 <!-- Right Section -->
 <div class="content">
    <!-- Search Bar -->
    <div class="search-container">
        <input type="text" class="search-input" placeholder="Find Courts">
        <span class="search-icon"><i class="fa fa-search"></i></span>
    </div>

    <!-- Court Cards -->
    <div class="court-cards">

        @forelse ($courts as $court)
            <div class="futsal-card"onclick="window.location='{{ route('user.courtDetails', $court->id) }}'">
                <img src="{{ asset('storage/uploads/' . $court->image) }}" alt="City Futsal Arena" />
                <div class="card-content">
                    <h3>{{ $court->courtName }}</h3>
                    <p class="location">{{ $court->courtLocation }}</p>
                    <div class="ratings">⭐⭐⭐⭐☆</div>
                    <p class="phone">📞 9801234567</p>
                    <p class="price">Rs. {{ $court->courtPrice }}</p>

                    <a href="#" class="arrow-btn">Book Now ➜</a>
                </div>
            </div>
        @empty
            <div class="alert alert-primary" role="alert">
                No futsal courts are available at the moment.
            </div>
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
