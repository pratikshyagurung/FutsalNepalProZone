@extends('futsal_owner.inc.main')

@section('container')
    <h1>Your Notifications</h1>

    @if($notifications->isEmpty())
        <p>No new notifications.</p>
    @else
        @foreach ($notifications as $notification)
            <div>
                <p>{{ $notification->data['message'] ?? 'New booking request received.' }}</p>
                <p>Booking ID: {{ $notification->data['booking_id'] ?? 'Unknown' }}</p>
                <p>Court ID: {{ $notification->data['court_id'] ?? 'Unknown' }}</p>
                <p>User ID: {{ $notification->data['user_id'] ?? 'Unknown' }}</p>

                <!-- Confirm Button -->
             <!-- Confirm Button -->
             <form action="{{ route('futsal_owner.notifications.confirm', $notification->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-success">Confirm</button>
            </form>
            
            <form action="{{ route('futsal_owner.notifications.cancel', $notification->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Cancel</button>
            </form>
            
            


                <hr>
            </div>
        @endforeach
    @endif
@endsection
