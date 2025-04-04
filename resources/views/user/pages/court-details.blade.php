@extends('user.inc.main')

@section('name', 'Pratikshya G')

@section('contents')

<style>
    /* Notification Container */
    .notification-container {
        margin: 0 auto 20px;
        max-width: 1200px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        border: 1px solid #e0e0e0;
    }
    
    /* Notification Alert */
    .notification-alert {
        position: relative;
        padding: 15px 20px;
        margin-bottom: 10px;
        border-radius: 4px;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    /* Success Style */
    .notification-alert.success {
        color: #155724;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
    }
    
    /* Danger Style */
    .notification-alert.danger {
        color: #721c24;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
    }
    
    /* Notification Content */
    .notification-content {
        flex: 1;
        min-width: 200px;
        padding-right: 10px;
    }
    
    /* Checkout Button */
    .notification-btn-checkout {
        padding: 8px 16px;
        background: #28a745;
        color: white;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        border: none;
        cursor: pointer;
        white-space: nowrap;
        transition: background 0.2s;
    }
    
    .notification-btn-checkout:hover {
        background: #218838;
    }
    
    /* Close Button */
    .notification-close {
        background: none;
        border: none;
        color: inherit;
        font-size: 22px;
        font-weight: bold;
        cursor: pointer;
        opacity: 0.7;
        padding: 0 5px;
        line-height: 1;
    }
    
    .notification-close:hover {
        opacity: 1;
    }
    
    /* Mark All Read Link */
    .mark-all-read {
        display: inline-block;
        margin-top: 5px;
        color: #6c757d;
        font-size: 14px;
        text-decoration: underline;
        cursor: pointer;
    }

    /* No Notifications */
    .no-notifications {
        text-align: center;
        font-size: 14px;
        color: #6c757d;
        padding: 10px;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .notification-alert {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .notification-btn-checkout {
            margin-top: 10px;
            margin-left: 0;
            width: 100%;
        }
    }
</style>




<div class="court-details-wrapper">
    <!-- Breadcrumb Navigation  -->
    <nav class="breadcrumb">
            <a href="/">Home</a> /
            <a href="{{ route('user.courts') }}">Courts</a> /
            <span>{{ $court->courtName }}</span>
    </nav>



    <!-- Court Details -->
    <div class="courtdetails-container">

        <!-- Court Image -->
        <div class="court-image">
            <img src="{{ asset('storage/uploads/' . $court->image) }}" />

                <button class="zoom-button">+</button>
        </div>

        <!-- Court Info -->
        <div class="court-info">
                <h1 class="court-title">{{ strtoupper($court->courtName) }}</h1>
                <p class="location"><i class='fas fa-map-marker-alt' style="color: green"></i> {{ $court->courtLocation }}</p>
                <p class="Description">{{ $court->courtDescription }}</p>

                <div class="court-specs">
                    <div class="input-box">
                        <h2 class="court-info-h2">Court Size</h2>
                        <p class="court-info-p">7-A</p>
                    </div>
                </div>
                
                {{-- hour --}}
                <div class="time-selection">
                    <h2 class="court-info-h2">How many hours you want to book?</h2>
                    <div class="custom-input">
                        <button class="minus" onclick="updateHours(-0.5)">-</button>
                        <input type="number" id="hourCount" min="1" max="6" step="0.5" value="1" readonly>
                        <button class="plus" onclick="updateHours(0.5)">+</button>
                    </div>
                </div>

                <p class="disclaimer">*Prices may vary based on peak hours and location.</p>
            <div class="input-box">    
                <h2 class="court-info-h2">Total</h2>
                <p class="court-info-p">Rs. <span id="totalPrice">{{ $court->courtPrice }}</span></p>
            </div>
                
            {{-- <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="Court_ID" value="{{ $court->id }}">
                <input type="hidden" name="totalPrice" id="totalPriceInput" value="{{ $court->courtPrice }}">
                <button type="submit">BOOK NOW</button>
            </form> --}}
            <form action="{{ route('courtbooking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="Court_ID" value="{{ $court->id }}">
                <input type="hidden" name="totalPrice" id="totalPriceInput" value="{{ $court->courtPrice }}">
                <button type="submit">BOOK NOW</button>
            </form>

        </div>

    </div>

</div>

<!-- Tabs Navigation -->
<div class="tabs">
    <button class="tab-btn active" onclick="showTab('courtDetails')">Court Details</button>
    <button class="tab-btn" onclick="showTab('feedback')">Feedback</button>
</div>

<!-- Tabs Content -->
<div class="tab-content">
    <!-- Court Details Section -->
    <div id="courtDetails" class="tab-pane active">
        <h2>Court Details</h2>
        <p>{{ $court->courtDescription }}</p>
        <p><strong>Size:</strong> 7-A</p>
        <p><strong>Location:</strong> {{ $court->courtLocation }}</p>
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
        
                @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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
    let pricePerHour = {{ $court->courtPrice }};
    let hours = document.getElementById('hourCount').value;
    let total = pricePerHour * hours;
    document.getElementById('totalPrice').innerText = total;
    document.getElementById('totalPriceInput').value = total; // Update hidden input
}

    document.addEventListener("DOMContentLoaded", function() {
    const zoomButton = document.querySelector(".zoom-button");
    const courtImage = document.querySelector(".court-image img");

    let isZoomed = false;

    zoomButton.addEventListener("click", function() {
        if (isZoomed) {
            courtImage.classList.remove("zoomed");
            zoomButton.innerText = "+";
        } else {
            courtImage.classList.add("zoomed");
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
