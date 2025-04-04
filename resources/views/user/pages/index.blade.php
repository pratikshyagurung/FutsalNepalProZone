    @extends('user.inc.main')
    
    @section('name', 'PratikshyaG')
    
    @section('contents')
    <!-- Hero Section with Slider -->
    <section class="hero">
        <div class="slider">
            <div class="slide active" style="background-image: url('{{ asset('assets/gifs/court.gif') }}')">
                <div class="hero-content">
                    <h1 class="fade-in">Unleash the Game, Embrace the Passion</h1>
                    <p class="fade-in delay">
                        Discover the best futsal arenas near you and experience the thrill like never before!
                    </p>
                    <a href="{{ route('user.courts') }}" class="cta-button">Find Your Futsal</a>
                </div>
            </div>
            <div class="slide" style="background-image: url('{{ asset('assets/gifs/ball.gif') }}')">
                <div class="hero-content-2">
                    <h1 class="fade-in">Feel the Rush, Control the Ball</h1>
                    <p class="fade-in delay">
                        Precision, speed, and skill—experience futsal at its finest.
                    </p>
                    <a href="{{ route('user.events') }}" class="cta-button">Join the Events</a>
                </div>
            </div>
            <div class="slide" style="background-image: url('{{ asset('assets/gifs/girl.gif') }}')">
                <div class="hero-content-3">
                    <h1 class="fade-in">Everyone's Game, Everyone's Passion</h1>
                    <p class="fade-in delay">
                        Whether you're a beginner or a pro, the court is yours to conquer!
                    </p>
                    <a href="#" class="cta-button">Contact Us</a>
                </div>
            </div>
    
            <!-- Slider Navigation Buttons -->
            <button class="prev" onclick="prevSlide()">&#10094;</button>
            <button class="next" onclick="nextSlide()">&#10095;</button>
    
            <!-- Dots for Navigation -->
            <div class="dots-container">
                <span class="dot active" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </div>
    </section>
    
    {{-- welcome section --}}
    <section class="features">
        <h2 class="key-features-title">Welcome to FutsalNepalProZone</h2>
        <p class="features-subtitle">
            Discover what makes our futsal platform stand out. Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda aspernatur cumque earum fuga hic l! Nulla, asperiores!
        </p>

        <div class="features-container">
            <div class="feature">
                <div class="feature-icon">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <h3>Easy Booking</h3>
                <p>
                    Effortlessly schedule your futsal games online with our user-friendly booking system.
                </p>
            </div>
    
            <div class="feature">
                <div class="feature-icon">
                    <i class="fa-solid fa-calendar-day"></i>
                </div>
                <h3>Events</h3>
                <p>
                    Participate in exciting events and showcase your futsal skills.
                </p>
            </div>
    
            <div class="feature">
                <div class="feature-icon">
                    <i class="fa-solid fa-futbol"></i>
                </div>
                <h3>Court Management</h3>
                <p>
                    Manage your futsal courts efficiently with advanced tools and real-time updates.
                </p>
            </div>
        </div>
    </section>

    {{-- functionality section --}}
    <section class="functionality-section">
        <div class="functionality-image">
            <img src="{{ asset('assets/images/mockup.png') }}" alt="Functionality Image">
        </div>
    
        <div class="functionality-texts">
            <div class="functionality-item">
                <i class="icon fas fa-gift"></i>
                <h3>Free Forever</h3>
                <p>Enjoy unlimited access with no hidden charges. Lorem ipsum dolor sipossimus architecto, magni excepturi provident.</p>
            </div>
            <div class="functionality-item">
                <i class="icon fas fa-archive"></i>
                <h3>Advanced Inventory</h3> 
                <p>Track and manage your futsal inventory effortlessly. Lorem ipsum dolor sit amet ca repellat ex dolorem beatae vero!</p>
            </div>
            <div class="functionality-item">
                <i class="icon fas fa-futbol"></i>
                <h3>Multi Futsal Court Management</h3>
                <p>Manage multiple futsal courts in a single dashboard. Lorem ipsum dolor sit amet consectetur ut dolor soluta reiciendis dolorum.</p>
            </div>
            <div class="functionality-item">
                <i class="icon fas fa-futbol"></i>
                <h3>Multi Futsal Court Management</h3>
                <p>Manage multiple futsal courts in a single dashboard. Lorem ipsum dolor sit amet consectetur ut dolor soluta reiciendis dolorum.</p>
            </div>
        </div>
    </section>

    <!-- futsal section -->
    <section class="futsal-section">
        <div class="container">
            <h5 class="subtitle">Featured Courts</h5>
            <h1 class="title">Courts</h1>
            <p class="description">
                 Lorem ipsum dolor sit amet iste commodi repudiandae alias earum tempora temporibus praesentium!.
            </p>
        </div>
        <div class="futsal-cards">

            @forelse ($courts as $court)
                <div class="futsal-card">
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
        <br>
        <a href="{{ route('user.courts') }}" class="btn">See all</a>

    </section>

    <section class="events-section">
        <div class="container">
            <h5 class="subtitle">Upcoming Events</h5>
            <h1 class="title">Events</h1>
            <p class="description">
                Stay updated with our latest events and gatherings. Join us and be a part of unforgettable experiences.
            </p>
    
            <div class="events-list">
                @forelse ($events as $event)
                    <div class="event-card active">
                        <img src="{{ asset('storage/uploads/' . $event->image) }}" alt="{{ $event->eventName }}">
                        <div class="event-info">
                            <h3>{{ $event->eventName }}</h3>
                            <p>{{ $event->eventDescription }}</p>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-primary" role="alert">
                        No futsal events are available at the moment.
                    </div>
                @endforelse
            </div>
    
            <br><br>
            <a href="{{ route('user.events') }}" class="btn">Join Games</a>
        </div>
    </section>
    

    {{-- wny choose section --}}
    <section class="why-choose">
        <div class="container">
            <h5 class="subtitle">We are better Here is why?</h5>
            <h1 class="title">Why choose FutsalNepalProZone</h1>
            <p class="description">
                 Stay updated with our latest events and gatherings. Join us and be a part of unforgettable experiences.
            </p>            
            <div class="why-choose-container">
                <div class="why-choose-image">
                    <img src="{{ asset('assets/images/futsal.jpg') }}" alt="Team Discussion">
                </div>
                <div class="why-choose-content">
                    
                    <div class="why-choose-item">
                        <i class="icon-class"></i>
                        <div>
                            <h3>Innovative Solutions</h3>
                            <p>We embrace creativity and cutting-edge technology to drive success. Lorem ipsum praesentium quaerat laudantium! Lorem ipsum praesentium quaerat laudantium!</p>
                        </div>
                    </div>
                    <div class="why-choose-item">
                        <i class="icon-class"></i>
                        <div>
                            <h3>Reliable Support</h3>
                            <p>Our team is available 24/7 to ensure you get the best assistance. Lorem ipsum praesentium quaerat laudantium!</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    
    <!-- about section -->
    <section class="about-us">
        <div class="about-content">
            <h2 class="about-title">Experience the Thrill of Futsal</h2>
            <p class="about-text">At Futsal Nepal ProZone, we bring passion, skill, and excitement together. Whether you're a pro or just getting started, our courts are open for all! Lorem ipsum dolor sit amet consectetur te tenetur corporis recusandae exercitationem, dolor enim. <br> <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas minus sed corporis! Perspiciatis, placeat tis odio error, dolores iste voluptatum et vel voluptates cumque quod.</p>
            <a href="#learn-more" class="btn">Learn More</a>
        </div>
        <div class="about-image">
            <img src="{{ asset('assets/images/playing.png') }}" alt="Futsal Match">
        </div>
    </section>

    {{-- picture of player with content section --}}
    <section class="digital-menu">
        <div class="container">
        <div class="why-choose-container">
            <div class="why-choose-image">
                <img src="{{ asset('assets/images/playing.png') }}" alt="Team Discussion">
            </div>
        <div class="why-choose-content">
            <div class="why-choose-item">
                <i class="icon-class"></i>
                <div>
                    <h3>Manage and create your digital courts</h3>
                    <p>With years of expertise, we deliver outstanding solutions tailored to your needs. Lorem ipsum praesentium quaerat laudantium!</p>
                </div>
            </div>
            <div class="why-choose-item">
                <i class="icon-class"></i>
                <div>
                    <h3>Increase your futsal's efficiency with a Digital court </h3>
                    <p style="position: relative; padding-left: 20px;">
                        <span style="position: absolute; left: 0;">•</span> 
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam voluptate labore aspernatur libero, porro et repellat perspiciatis, accusamus ducimus inventore suscipit adipisci.
                    </p>
                    <p style="position: relative; padding-left: 20px;">
                        <span style="position: absolute; left: 0;">•</span> 
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam voluptate labore aspernatur libero, porro et repellat perspiciatis, accusamus ducimus inventore suscipit adipisci.
                    </p>                    
                </div>
            </div>
        </div>
    </div>
</div>
    </section>
    {{-- testimonial section --}}
    <section class="testimonials-section">
            <div class="container">
                <h5 class="subtitle">Stories from our customers</h5>
                <h1 class="title">Testimonials</h1>
                <p class="description">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium ad doloremque dolorem natus culpa.
                </p>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                      <img src="{{ asset('assets/images/player1.png') }}" alt="User 1" />
                      <p class="testimonial-text">"Amazing experience! Highly recommended."</p>
                      <h3 class="testimonial-name">John Doe</h3>
                      <p class="testimonial-role">CEO, Company A</p>
                  </div>
                  
                
                  
                  <div class="swiper-slide">
                      <img src="{{ asset('assets/images/girl1.png') }}" alt="User 3" />
                      <p class="testimonial-text">"A truly wonderful experience, I’ll be back!"</p>
                      <h3 class="testimonial-name">David Miller</h3>
                      <p class="testimonial-role">Entrepreneur</p>
                  </div>
                  <div class="swiper-slide">
                    <img src="{{ asset('assets/images/redboy.png') }}" alt="User 1" />
                    <p class="testimonial-text">"Amazing experience! Highly recommended."</p>
                    <h3 class="testimonial-name">John Doe</h3>
                    <p class="testimonial-role">CEO, Company A</p>
                </div>
                
                <div class="swiper-slide">
                    <img src="{{ asset('assets/images/pratikshya.png') }}" alt="User 2" />
                    <p class="testimonial-text">"Great service and fantastic team support!"</p>
                    <h3 class="testimonial-name">Pratikshya Gurung</h3>
                    <p class="testimonial-role">Captain, KamalPokhari Womens Football.</p>
                </div>
                
                <div class="swiper-slide">
                    <img src="{{ asset('assets/images/jr.png') }}" alt="User 3" />
                    <p class="testimonial-text">"A truly wonderful experience, I’ll be back!"</p>
                    <h3 class="testimonial-name">David Miller</h3>
                    <p class="testimonial-role">Entrepreneur</p>
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/images/girl2.png') }}" alt="User 2" />
                    <p class="testimonial-text">"Great service and fantastic team support!"</p>
                    <h3 class="testimonial-name">Jane Smith</h3>
                    <p class="testimonial-role">Designer, Brand B</p>
                </div>
            </div>
            <div class="swiper-pagination "></div>

          </div>
            </div>
    </section>

    @endsection
