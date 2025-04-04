@extends('user.inc.main')

@section('contents')
<div class="checkout-container">
    <h2 class="checkout-title">Checkout</h2>
    <div class="checkout-header">
        <div class="checkout-steps">
            <div class="step">1. Court</div>
            <div class="step">2. Booking</div>
            <div class="step active">3. Payment</div>
            <div class="step">4. Confirm</div>
        </div>
    </div>

    {{-- <div class="checkout-body">
        <h3>Select Payment Method</h3>
        
        <div class="payment-options-container">
            <div class="dropdown">
                <button class="dropdown-toggle">
                    <span>Digital Wallets</span>
                    <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
                <div class="dropdown-menu">
                    <div class="payment-method active">
                        <img src="{{ asset('assets/images/khalti.png') }}" alt="Khalti" class="payment-icon">
                        <span>Khalti</span>
                    </div>
                    <div class="payment-method">
                        <img src="{{ asset('assets/images/esewa.png') }}" alt="Esewa" class="payment-icon">
                        <span>Esewa</span>
                    </div>
                </div>
            </div>
            
    
            <div class="main-payment-methods">
                <div class="payment-option">
                    <img src="{{ asset('assets/images/khalti.png') }}" alt="khalti" class="payment-logo">
                </div>
                <div class="payment-option">
                    <img src="{{ asset('assets/images/esewa.png') }}" alt="esewa" class="payment-logo">
                </div>
            </div>
        </div> --}}

        <div class="checkout-details-wrapper">
            <!-- Left Side - Resource Image -->
            <div class="checkout-image">
                @if($resource->image ?? false)
                    <img src="{{ asset('storage/uploads/' . $resource->image) }}" alt="{{ $type == 'court' ? $resource->courtName : $resource->eventName }}">
                    <button class="zoom-button">+</button>
                @else
                    <div class="no-court-placeholder">
                        <p>{{ ucfirst($type) }} information not available</p>
                    </div>
                @endif
            </div>
    
            <!-- Right Side - Order Summary -->
            <div class="booking-summary-checkout">
                <div class="booking-header">
                    <div class="booking-id">
                        <span class="id-label">BOOKING ID</span>
                        <span class="id-value">{{ $booking->id }}</span>
                    </div>
                    <div class="checkout-info">
                        <h3 class="resource-name">
                            {{ strtoupper($type == 'court' ? $resource->courtName : $resource->eventName) }}
                        </h3>
                        <p class="resource-description">
                            {{ $type == 'court' ? $resource->courtDescription : $resource->eventDescription }}
                        </p>
                        @if($type == 'court')
                        <div class="court-size">
                            <span class="size-icon">↔</span>
                            <span>7-A size</span>
                        </div>
                        @endif
                    </div>
                </div>
                
                <p>Payment Summary</p>
                <div class="payment-summary">
                    @if($type == 'court')
                    <div class="summary-item">
                        <span class="id-label">Hour </span>
                        <span id="hour">3 hr </span>
                    </div>
                    @endif
                    
                    <div class="summary-item">
                        <span class="id-label">{{ strtoupper($type == 'court' ? $resource->courtName : $resource->eventName) }}</span>
                        <span class="id-label">Rs. <span id="totalPrice">{{ $booking->TotalPrice }}</span></span>
                    </div>
                   
                    <div class="summary-item-discount">
                        <p class="summary-total">Total Price <span id="totalPrice">{{ $booking->TotalPrice }}</span></p>
                    </div>
                </div>
                
                <button id="payment-button">Pay with Khalti</button>
            </div>
        </div>
    </div>
</div>
<script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>

<script>
    var config = {
        // khalti provides below parameters 
        // actual public key jun xa environment variable vitra tyo chai ya use hunxa

        //yo ho public test key if hamle yo test public key use garera transaction complete vayesi balla live public key dinxa  
        // "publicKey": "{{ config ('app.Khalti_public_key') }}", 
        "productIdentity": "1234567890",
        // "publicKey": "6bb48827ce3842c88053b1e8e77b4174",
        // "secretKey":"a9bc86b6df8e4825a044dec4704a4994",
        "productName": "Dragon",
        "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
        "paymentPreference": [
            "KHALTI",
            "EBANKING",
            "MOBILE_BANKING",
            "CONNECT_IPS",
            "SCT",
            ],
        "eventHandler": {
            //payment success vayesi execute huni haru function below
            onSuccess (payload) {
                // hit merchant api for initiating verfication
                console.log(payload);
            },
            //payment error ayera execute huni haru function below

            onError (error) {
                console.log(error);
            },
            onClose () {
                // console.log('widget is closing');
            }
        }
    };

    var checkout = new KhaltiCheckout(config);
    var btn = document.getElementById("payment-button");
    btn.onclick = function () {
        // minimum transaction amount must be 10, i.e 1000 in paisa.
        checkout.show({amount: 1000});
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggle = document.querySelector('.dropdown-toggle');
        const dropdown = document.querySelector('.dropdown');
        
        dropdownToggle.addEventListener('click', function() {
            dropdown.classList.toggle('active');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });

        // Payment method selection
        document.querySelectorAll('.payment-method').forEach(method => {
            method.addEventListener('click', () => {
                document.querySelectorAll('.payment-method').forEach(m => {
                    m.classList.remove('active');
                });
                method.classList.add('active');
            });
        });

        // Image zoom functionality
        const zoomButton = document.querySelector(".zoom-button");
        if (zoomButton) {
            const resourceImage = document.querySelector(".checkout-image img");
            let isZoomed = false;

            zoomButton.addEventListener("click", function() {
                if (isZoomed) {
                    resourceImage.classList.remove("zoomed");
                    zoomButton.innerText = "+";
                } else {
                    resourceImage.classList.add("zoomed");
                    zoomButton.innerText = "-";
                }
                isZoomed = !isZoomed;
            });
        }
    });
</script>
@endsection