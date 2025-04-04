  <!-- =============== Navigation ================ -->
  <div class="navigation">
    <ul>
        <li>
            <a href="#">
                <span class="icon">
                    <ion-icon name="football-outline"></ion-icon>
                </span>
                <span class="title">FutsalNepalProZone</span>
            </a>
        </li>

        <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <span class="icon">
                    <ion-icon name="home-outline"></ion-icon>
                </span>
                <span class="title">Dashboard</span>
            </a>
        </li>

        <li class="{{ request()->is('courts/create') ? 'active' : '' }}">
            <a href="{{ url('/courts/create') }}">
                <span class="icon">
                    <ion-icon name="grid-outline"></ion-icon>
                </span>
                <span class="title">Court Management</span>
            </a>
        </li>

        <li class="{{ request()->is('courts') ? 'active' : '' }}">
            <a href="{{ route('courts.index') }}">
                <span class="icon">
                    <ion-icon name="grid-outline"></ion-icon>
                </span>
                <span class="title">Court Index</span>
            </a>
        </li>

        <li class="{{ request()->is('timeslots') ? 'active' : '' }}">
            <a href="/timeslots">
                <span class="icon">
                    <ion-icon name="time-outline"></ion-icon>
                </span>
                <span class="title">Timeslots</span>
            </a>
        </li>

        {{-- <li class="{{ request()->routeIs('owner-allbooking') ? 'active' : '' }}">
            <a href="{{ route('owner-bookings') }}">
                <span class="icon">
                    <ion-icon name="calendar-outline"></ion-icon>
                </span>
                <span class="title">Bookings</span>
            </a>
        </li> --}}
        
        <li class="{{ request()->routeIs('owner.courtbookings') ? 'active' : '' }}">
            <a href="{{ url('bookings.courtbooking') }}">
                <span class="icon">
                    <ion-icon name="calendar-outline"></ion-icon>
                </span>
                <span class="title">Court Bookings</span>
            </a>
        </li>
        
     <!-- Event Bookings Link -->
     <li class="{{ request()->routeIs('owner.eventbookings') ? 'active' : '' }}">
        <a href="{{ url('bookings') }}">
            <span class="icon">
                <ion-icon name="calendar-outline"></ion-icon>
            </span>
            <span class="title">Event Bookings</span>
        </a>
    </li>
                

        <li class="{{ request()->is('events/create') ? 'active' : '' }}">
            <a href="{{ url('/events/create') }}">
                <span class="icon">
                    <ion-icon name="trophy-outline"></ion-icon>
                </span>
                <span class="title">Events</span>
            </a>
        </li>

        <li class="{{ request()->is('events') ? 'active' : '' }}">
            <a href="{{ route('events.index') }}">
                <span class="icon">
                    <ion-icon name="trophy-outline"></ion-icon>
                </span>
                <span class="title">Event Index</span>
            </a>
        </li>

        <li class="{{ request()->is('payments') ? 'active' : '' }}">
            <a href="/payments">
                <span class="icon">
                    <ion-icon name="cash-outline"></ion-icon>
                </span>
                <span class="title">Payments</span>
            </a>
        </li>

        <li class="{{ request()->is('reviews') ? 'active' : '' }}">
            <a href="/reviews">
                <span class="icon">
                    <ion-icon name="star-outline"></ion-icon>
                </span>
                <span class="title">Reviews</span>
            </a>
        </li>

        <li class="{{ request()->is('notifications') ? 'active' : '' }}">
            <a href="{{ route('futsal_owner.notifications.allnotification') }}">
                <span class="icon">
                    <ion-icon name="notifications-outline"></ion-icon>
                </span>
                <span class="title">Notifications</span>
            </a>
        </li>
        

        <li class="{{ request()->is('settings') ? 'active' : '' }}">
            <a href="/settings">
                <span class="icon">
                    <ion-icon name="settings-outline"></ion-icon>
                </span>
                <span class="title">Settings</span>
            </a>
        </li>

        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary">Logout</button>
            </form>
        </li>
    </ul>
</div>