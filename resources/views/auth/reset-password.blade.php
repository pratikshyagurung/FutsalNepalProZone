<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
    <title>Reset Password</title>
</head>

<body>
    <div class="container">
        <div class="image-section-2">
            <img src="{{ asset('assets/images/Login.png') }}" />
        </div>
        <div class="form-section">
            <div class="form-container">
                <h1 class="form-title">
                    Reset Your Password
                </h1>
                <p class="form-subtitle">
                    Don't worry, we'll help you set a new one in no time!
                </p>

                <!-- Form Start -->
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address Input -->
                    <div class="single-input">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full input-spacing" type="email"
                            name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- New Password Input -->
                    <div class="single-input mt-4">
                        <x-input-label for="password" :value="__('New Password')" />
                        <x-text-input id="password"
                            class="block mt-1 w-full input-spacing 
                         @error('password') border-red-500 @enderror"
                            type="password" name="password" required autocomplete="new-password" />
                        {{-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="single-input mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm New Password')" />
                        <x-text-input id="password_confirmation"
                            class="block mt-1 w-full input-spacing 
                         @error('password_confirmation') border-red-500 @enderror"
                            type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Display Errors if any -->
                    @if ($errors->any())
                        <div class="error-message">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <!-- Reset Password Button -->
                    <div class="form-footer mt-6">
                        <x-primary-button>
                            {{ __('Reset Password') }}
                        </x-primary-button>
                    </div>
                </form>

                <!-- Back to Login Link -->
                <div class="form-footer mt-4">
                    <a href="{{ route('login') }}" class="back-to-login">
                        Remembered your password?
                        <span style="color: #003a27;">Login Here</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
