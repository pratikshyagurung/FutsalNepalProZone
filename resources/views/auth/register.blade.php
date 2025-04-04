<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
    <title>Registration Page</title>
</head>

<body>
    <div class="container">
        <div class="image-section-1">
            <img src="{{ asset('assets/images/football.png') }}" />
        </div>
        <div class="form-section">
            <div class="form-container">
                <h1 class="form-title">
                    Let's Start <br>
                    With Registration!
                </h1>
                <form method="POST" action="{{ route('register') }}" onsubmit="validateForm(event)">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="first_name" placeholder="First Name" />
                        <input type="text" name="last_name" placeholder="Last Name" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" placeholder="Phone No." />
                        <input type="date" name="dob" />
                    </div>

                    <div class="form-group">
                        <input type="text" name="address" placeholder="Address" />
                    </div>

                    <div class="single-input">
                        <input type="email" name="email" placeholder="Email" />
                    </div>
                    <div class="single-input">
                        <input type="password" name="password" placeholder="Password" />
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" id="terms" name="terms" />
                        <label for="terms">
                            I agree to the
                            <span style="color: #003a27">terms & conditions</span>
                            and
                            <span style="color: #003a27">Privacy Policy</span>.
                        </label>
                    </div>
                    <div class="form-footer">
                        <button type="submit">Create Account</button>
                        <a href="{{ route('login') }}">
                            Already have an account?
                            <span style="color: #003a27">Log in</span>
                        </a>
                        {{-- <div class="form-footer mt-4">
                            <a href="{{ route('login') }}" class="back-to-login">
                                Already have an account? <span>Log in</span>
                            </a>
                        </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

<script>
    function validateForm(event) {
        event.preventDefault();

        const firstName = document.querySelector('[placeholder="First Name"]');
        const lastName = document.querySelector('[placeholder="Last Name"]');
        const phone = document.querySelector('[placeholder="Phone No."]');
        const dob = document.querySelector('[name="dob"]');
        const email = document.querySelector('[placeholder="Email"]');
        const password = document.querySelector('[placeholder="Password"]');
        const terms = document.getElementById("terms");

        let isValid = true;

        clearErrors();

        if (!firstName.value.trim()) {
            showError(firstName, "First name is required.");
            isValid = false;
        }

        if (!lastName.value.trim()) {
            showError(lastName, "Last name is required.");
            isValid = false;
        }

        if (!phone.value.trim() || !/^[0-9]{10}$/.test(phone.value)) {
            showError(phone, "Valid phone number is required.");
            isValid = false;
        }

        if (!dob.value) {
            showError(dob, "Date of birth is required.");
            isValid = false;
        }

        if (!email.value.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            showError(email, "Valid email is required.");
            isValid = false;
        }

        if (!password.value.trim() || password.value.length < 6) {
            showError(password, "Password must be at least 6 characters long.");
            isValid = false;
        }

        if (!terms.checked) {
            alert("You must agree to the terms and conditions.");
            isValid = false;
        }

        if (isValid) {
            alert("Form submitted successfully!");
            // Uncomment the line below to allow form submission:
            event.target.submit(); // Submit the form programmatically
        }
    }

    function showError(input, message) {
        const error = document.createElement("div");
        error.className = "error";
        error.textContent = message;
        input.parentElement.appendChild(error);
    }

    function clearErrors() {
        const errors = document.querySelectorAll(".error");
        errors.forEach((error) => error.remove());
    }
</script>

</html>
