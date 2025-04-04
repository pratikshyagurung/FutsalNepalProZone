<div class="logo-container">
    <img class="logo" src="logo.png" alt="FutsalNepalProZone" />


<!-- Profile & Mobile Menu Toggle -->

<button class="mobile-nav-toggle" id="menuButton" onclick="toggleSidebar()">☰ Menu</button>
</div>
<!-- Sidebar Navigation -->
<nav id="sidebar" class="sidebar">
    <button class="close-btn" onclick="toggleSidebar()">✖</button>
    <ul class="sidebar-navigation">
        <li class="{{ request()->routeIs('index') ? 'active' : '' }}">
            <a href="{{ route('index') }}">Home</a>
        </li>
        <li>
            <a href="{{ route('user.courts') }}">Courts</a>
        </li> 
        <li >
            <a href="{{ route('user.events') }}">Events</a>
        </li>
        <li>
            <a href="{{ route('user.timeslots') }}">Time Slots</a>
        </li>
        {{-- <li >
            <a href="{{ route('user.location') }}">Location</a>
        </li>
        <li >
            <a href="{{ route('user.aboutus') }}">About Us</a>
        </li>
        <li >
            <a href="{{ route('user.contactus') }}">Contact Us</a>
        </li> --}}
    </ul>

    <!-- Profile Section Inside Sidebar -->
    <div class="sidebar-profile">
        <div class="profile-icon">@yield('name')</div>
        <div class="dropdown-menu">

            <a href="#">Settings</a>
            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary">Logout</button>
            </form>
         @endauth
         
        </div>
    </div>
</nav>
</header>

