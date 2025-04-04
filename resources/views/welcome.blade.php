<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Welcome Page</title>
    <style>
        @font-face {
            font-family: "Aurora";
            src: url(Aurora.otf);
        }

        body,
        html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            /* Light background for other sections */
        }

        .hero {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: url('assets/images/futsal.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .hero h1,
        .btn-container {
            font-family: "Aurora";
            position: relative;
            z-index: 5;

        }

        .btn-container a {
            margin: 10px;
            padding: 15px 30px;
            border: 2px solid white;
            /* Border color */
            background-color: transparent;
            /* No background */
            color: white;
            /* Text color */
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease, color 0.3s ease;
        }

        .btn-container a:hover {
            background-color: #3E7B27;
            /* Dark green background on hover */
            border: 2px #3E7B27;

            /* White text on hover */
            transform: scale(1.1);
        }


        .key-features-title {
            text-align: center;
            font-size: 2.5em;
            color: #003a27;
            margin: 60px 0 20px 0;
            animation: fadeInDown 1s ease-out;
        }

        .features {
            display: flex;
            justify-content: space-around;
            padding: 80px 20px;
            gap: 50px;
        }

        .feature-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 280px;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .feature-box h3 i {
            color: #003a27;
            margin-right: 10px;
            font-size: 1.4em;
            vertical-align: middle;
        }


        .feature-box:hover {
            transform: translateY(-15px) scale(1.05);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .feature-box h3 {
            color: #003a27;
            margin-bottom: 15px;
        }

        .feature-box p {
            line-height: 1.6;
            color: #333;
        }

        footer {
            background-color: #003a27;
            color: white;
            text-align: center;
            padding: 15px 0;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="hero">
        <h1>Welcome to FutsalNepalProZone</h1>
        <div class="btn-container">
            @if (Route::has('login'))
                <nav>
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </div>

    <h2 class="key-features-title">Key Features</h2>

    <div class="features">
        <div class="feature-box">
            <h3><i class="fa-solid fa-calendar-check"></i> Easy Booking </h3>
            <p>
                Effortlessly schedule your futsal games online with our user-friendly
                booking system.
            </p>
        </div>
        <div class="feature-box">
            <h3><i class="fa-solid fa-calendar-day"></i> Events</h3>
            <p>
                Participate in exciting events, and engage in activities
                that showcase your futsal skills.
            </p>
        </div>

        <div class="feature-box">
            <h3><i class="fa-solid fa-futbol"></i> Court Management</h3>
            <p>
                Manage your futsal courts efficiently with advanced tools and
                real-time updates.
            </p>
        </div>
    </div>

    <footer>&copy; 2024 FutsalNepalProZone. All rights reserved.</footer>
</body>

</html>
