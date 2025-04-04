@extends('user.inc.main')
    
@section('name', 'PratikshyaG')

@section('contents')

@section('contents')

<div class="courthero">
    <img src="{{ asset('assets/images/futsal.jpg') }}" alt="Background">
    <h2 class="courthero-h2">BOOK YOUR SLOT ONLINE NOW</h2>
</div>
<div class="container">
    
    <div class="status-legend">
        <span class="status available">● Available</span>
        <span class="status booked">● Un Available</span>
        <span class="status closed">● Booked</span>
    </div>
    
    <div class="date-selector">
        <label>Select Date:</label>
        <input type="date" id="date-picker">
    </div>
    
    <div class="timeslot-grid">
        <div class="timeslot-row">
            <div class="court-name">COURT GENTING</div>
            <div class="timeslot available">6:00PM - 7:00PM</div>
            <div class="timeslot booked">7:00PM - 8:00PM</div>
            <div class="timeslot available">8:00PM - 9:00PM</div>
        </div>

    </div>
</div>

@endsection
