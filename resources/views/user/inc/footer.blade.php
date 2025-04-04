{{-- footer section --}}
<footer>
    <div class="waves">
        <div class="wave" id="wave1"></div>
        <div class="wave" id="wave2"></div>
        <div class="wave" id="wave3"></div>
        <div class="wave" id="wave4"></div>
    </div>
    <ul class="social-icons">
        <li>
            <a href="https://github.com/pratikshyagurung"><i class="fa-brands fa-github"></i></a>
            <a href="mailto:pratikshyag82@gmail.com?subject=Inquiry&body=Hello, I have a question about...">
                <i class="fa-solid fa-envelope"></i>
            </a>
            <a href="https://www.linkedin.com/in/pratikshya-gurung-649224262/"><i class="fa-brands fa-linkedin"></i></a>
            <a href="tel:+98171712739">
                <i class="fa-solid fa-phone"></i>
            </a>
        </li>
    </ul>
    <ul class="menu">
        <li>
            <a href="index.blade.php">Home</a>
            <a href="courts.blade.php">Courts</a>
            <a href="events.blade.php">Events</a>
            <a href="timeslots.blade.php">Time Slots</a>
            <a href="location.blade.php">Location</a>
            <a href="aboutus.blade.php">About Us</a>
            <a href="contactus.blade.php">Contact Us</a>
        </li>
    </ul>
    <p>&copy; 2024 FutsalNepalProZone. All rights reserved.</p>
</footer>

<script>
    function toggleSidebar() {
        let sidebar = document.getElementById("sidebar");
        let menuButton = document.getElementById("menuButton");
        sidebar.classList.toggle("active");
        
        // Hide menu button when sidebar is active
        if (sidebar.classList.contains("active")) {
            menuButton.style.display = "none";
        } else {
            menuButton.style.display = "block";
        }
    }

    window.addEventListener("scroll", function () {
        let header = document.querySelector(".primary-header");
        if (window.scrollY > 50) {
            header.classList.add("scrolled"); // Adds dark blue background on scroll
        } else {
            header.classList.remove("scrolled"); // Transparent when at top
        }
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- Initialize Swiper of testimonial section -->
<script>
    var swiper = new Swiper(".mySwiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 3, /* Ensures 3 cards are visible */
        loop: true, /* Infinite loop */
        coverflowEffect: {
            rotate: 20, /* Rotation for 3D effect */
            stretch: 0,
            depth: 200, /* Depth for realistic 3D effect */
            modifier: 1,
            slideShadows: true,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true, /* Allows clicking on dots */
        },

    });

</script>

</body>

</html>
