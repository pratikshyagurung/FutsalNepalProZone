<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
    <title>Login Page</title>
</head>

<body>
    <div class="container">
        <div class="image-section-2">
            <img src="{{ asset('assets/images/Login.png') }}" />
        </div>
        <div class="form-section">
            <div class="form-container">
                <h1 class="form-title">
                    Hey, <br />
                    Welcome Back.
                </h1>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="single-input">
                        <input name="email" type="email" placeholder="Email" />

                    </div>
                    <div class="single-input">
                        <input name="password" type="password" placeholder="Password" />
                        <div class="error-message"></div>
                    </div>

                    @if ($errors->any())
                        <div class="error-message">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="forgot-password">
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>

                    <div class="form-footer">
                        <button type="submit" name="submit">Log in</button>

                        <a href="{{ route('register') }}">
                            New on our platform?
                            <span style="color: #003a27">Create an account</span>
                        </a>

                    </div>
                </form>
            </div>
        </div>

    </div>
</body>

</html>
