<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
    <title>Password Reset</title>
</head>

<body>
    <div class="container">
        <div class="image-section-2">
            <img src="{{ asset('assets/images/Login.png') }}" />
        </div>
        <div class="form-section">
            <div class="form-container">
                <h1 class="form-title-forgotPW">
                    Forgot your password? <br />
                    No worries, we'll help you!
                </h1>
                <p class="form-subtitle">
                    Just enter your email address below, and we'll send you a password reset link.
                </p>

                <!-- Form -->
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address Input -->
                    <div class="single-input">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full input-spacing" type="email"
                            name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 error-message" />
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" style="color: green;" />

                    <!-- Submit Button -->
                    <div class="form-footer">
                        <x-primary-button>{{ __('Send Password Reset Link') }}</x-primary-button>
                    </div>
                </form>

                <!-- Link to Login -->
                <div class="form-footer mt-4">
                    <a href="{{ route('login') }}" class="back-to-login">
                        Remembered your password? <span>Log in</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
