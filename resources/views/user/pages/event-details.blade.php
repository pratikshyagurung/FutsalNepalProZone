@extends('user.inc.main')

@section('name', 'Pratikshya G')

@section('contents')


<div class="court-details-wrapper">
    <!-- Breadcrumb Navigation  -->
    <nav class="breadcrumb">
            <a href="/">Home</a> /
            <a href="{{ route('user.events') }}">Events</a> /
            <span>{{ $event->eventName }}</span>
    </nav>
    <!-- Event Details -->
    <div class="courtdetails-container">

        <!-- Event Image -->
        <div class="court-image">
                <img src="{{ asset('storage/uploads/' . $event->image) }}" alt="{{ $event->eventName }}">
                <button class="zoom-button">+</button>
        </div>

        <!-- Event Info -->
        <div class="court-info">
                <h1 class="event-title">{{ strtoupper($event->eventName) }}</h1>
                <p class="location"><i class='fas fa-map-marker-alt' style="color: green"></i> {{ $event->eventLocation }}</p>
                <p class="Description">{{ $event->eventDescription }}</p>

                <div class="event-specs">
                    <div class="input-box">
                        <h2 class="event-info-h2">Event Size</h2>
                        <p class="event-info-p">7-A</p>
                    </div>
                </div>
                
                <div class="time-selection">
                    <h2 class="event-info-h2">How many hours you want to book?</h2>
                    <div class="custom-input">
                        <button class="minus" onclick="updateHours(-0.5)">-</button>
                        <input type="number" id="hourCount" min="1" max="6" step="0.5" value="1" readonly>
                        <button class="plus" onclick="updateHours(0.5)">+</button>
                    </div>
                </div>

                <p class="disclaimer">*Prices may vary based on peak hours and location.</p>
            <div class="input-box">    
                <h2 class="event-info-h2">Total</h2>
                <p class="event-info-p">Rs. <span id="totalPrice">{{ $event->eventPrice }}</span></p>
            </div>

            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="Event_ID" value="{{ $event->id }}">
                <input type="hidden" name="totalPrice" id="totalPriceInput" value="{{ $event->eventPrice }}">
                <button type="submit">BOOK NOW</button>
            </form>
        </div>
    </div>
</div>

<!-- Tabs Navigation -->
<div class="tabs">
    <button class="tab-btn active" onclick="showTab('eventDetails')">Event Details</button>
    <button class="tab-btn" onclick="showTab('feedback')">Feedback</button>
</div>

<!-- Tabs Content -->
<div class="tab-content">
    <!-- Event Details Section -->
    <div id="eventDetails" class="tab-pane active">
        <h2>Event Details</h2>
        <p>{{ $event->eventDescription }}</p>
        <p><strong>Size:</strong> 7-A</p>
        <p><strong>Location:</strong> {{ $event->eventLocation }}</p>
        <p><strong>Feedbacks from Customers: </strong></p>
    </div>

    <!-- Feedback Section -->

        <div id="feedback" class="tab-pane">
            <h2>Feedback</h2>
            
            <form action="#" method="POST">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>
        
                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
        
                <label for="rating">Rating (1-5):</label>
                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5">
                    <label for="star5">★</label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4">★</label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3">★</label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2">★</label>
                    <input type="radio" id="star1" name="rating" value="1">
                    <label for="star1">★</label>
                </div>
        
                <label for="message">Your Feedback:</label>
                <textarea id="message" name="message" rows="4" placeholder="Write your feedback here..." required></textarea>
        
                <button type="submit">Submit Feedback</button>
            </form>
        </div>
            
</div>

<script>
    function updateHours(value) {
        let hourInput = document.getElementById('hourCount');
        let newValue = parseFloat(hourInput.value) + value;
        if (newValue >= 1 && newValue <= 6) {
            hourInput.value = newValue;
            updateTotal();
        }
    }

    function updateTotal() {
        let pricePerHour = {{ $event->eventPrice }};
        let hours = document.getElementById('hourCount').value;
        document.getElementById('totalPrice').innerText = pricePerHour * hours;
    }

    document.addEventListener("DOMContentLoaded", function() {
    const zoomButton = document.querySelector(".zoom-button");
    const eventImage = document.querySelector(".event-image img");

    let isZoomed = false;

    zoomButton.addEventListener("click", function() {
        if (isZoomed) {
            eventImage.classList.remove("zoomed");
            zoomButton.innerText = "+";
        } else {
            eventImage.classList.add("zoomed");
            zoomButton.innerText = "-";
        }
        isZoomed = !isZoomed;
    });
});

function showTab(tabId) {
    // Hide all tabs
    document.querySelectorAll('.tab-pane').forEach(tab => tab.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));

    // Show the selected tab
    document.getElementById(tabId).classList.add('active');
    document.querySelector(`[onclick="showTab('${tabId}')"]`).classList.add('active');
}
</script>
@endsection
