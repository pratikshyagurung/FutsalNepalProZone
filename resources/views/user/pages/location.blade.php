<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets/css/frontend.css') }}" />
    <script src="{{ asset('assets/js/nav.js') }}" defer></script>
    <title>Home Page</title>
</head>

<body>
    <header class="primary-header flex">
        <img class="logo" src="logo.png" alt="Logo" />

        <!-- Mobile Menu Toggle -->
        <button class="mobile-nav-toggle" aria-expanded="false"></button>

        <!-- Navigation -->
        <nav>
            <ul id="primary-navigation" data-visible="false" class="primary-navigation flex">
                <li class="active"><a href="index.blade.php">Home</a></li>
                <li><a href="courts.blade.php">Courts</a></li>
                <li><a href="events.blade.php">Events</a></li>
                <li><a href="timeslots.blade.php">Time Slots</a></li>
                <li><a href="location.blade.php">Location</a></li>
                <li><a href="aboutus.blade.php">About Us</a></li>
                <li><a href="contactus.blade.php">Contact Us</a></li>
            </ul>
        </nav>

        <!-- Search Bar & Profile -->
        <div class="right-section flex">
            {{-- <input type="text" class="search-bar" placeholder="Search..." /> --}}

            <div class="profile-container">
                <div class="profile-icon">PG</div>
                <div class="dropdown-menu">
                    <a href="#">Profile</a>
                    <a href="#">Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button class="btn btn-primary"> logout</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

<x-app-layout>
<div class="py-12" id="courts">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form class="flex items-center justify-center" v-on:submit.prevent="fetchCourts">
            <x-text-input class="py-4 px-6 w-1/2"
                        placeholder="Find a court near you"
                        v-model="courtName" />
            <x-primary-button class="ml-4 py-4">Search</x-primary-button>
        </form>

        <div class="mt-8 shadow-sm sm:rounded-lg">
            <div v-show="locationErrorMessage" class="text-center">@{{ locationErrorMessage }}</div>
            <div v-show="loading" class="text-center">Loading....</div>
            <div v-show="!loading" class="grid grid-cols-3 gap-4" style="display: none;">
                <div class="p-6 bg-white border-b border-gray-200"
                    v-for="court in courts"
                    :key="court.id">
                    <div class="text-xl">@{{ court.name }}</div>
                    <div class="mt-4 text-gray-500"
                        v-if="cout.distance">@{{ parseInt(court.distance).toLocaleString() }}m away</div>
                </div>    
            </div>

        </div>
    </div>
</div>
@push('script')
<script src="https://unpkg.com/vue@next"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    Vue.createApp({
        data(){
            return{
                courtName: "",
                long: "",
                lat: "",
                courts: [],
                loading: false,
                locationErrorMessage: "",
            }
        },
        methods: {
            fetchCourts() {
                this.loading = true;
                axios.get('/user.pages.location',{
                    params: {
                        courtName: this.courtName,
                        long: this.long,
                        lat: this.lat,
                    }
                }),then(res => {
                    this.courts = res.data.courts;
                }).finally(() => {
                    this.loading = false;
                })
            },

            getLocation(closure){
                if(navigator.geolocation){
                    navigator.geolocation.getCurrentPosition((position)=> {
                        this.long = position.coords.longitude;
                        this.lat = position.coords.latitude;
                        this.locationErrorMessage = "";

                        closure()
                    },(error) => {
                        if (error.code == 1){
                            this.locationErrorMessage = "Please allow location access.";
                        }
                    });
                }else {
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }
            }

        },
        mounted(){
            this.getLocation(()=>{
                this.fetchCourts();
            });
        },
    }).mount('#courts');
</script>
@endpush

</x-app-layout>
</body>

</html>