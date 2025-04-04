<x-guest-layout>
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f7fc;">
        <div
            style="max-width: 400px; width: 100%; background-color: #fff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 8px; padding: 30px; text-align: center;">
            <!-- Form Title -->
            <h1 style="font-size: 24px; font-weight: bold; color: #003a27; margin-bottom: 20px;">
                Verify Your Email Address
            </h1>

            <!-- Form Description -->
            <p style="font-size: 16px; color: #666; margin-bottom: 30px;">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the
                link we just emailed to you? If you didn't receive the email, we will gladly send you another.
            </p>

            <!-- Session Status -->
            @if (session('status') == 'verification-link-sent')
                <div style="margin-bottom: 20px; font-size: 14px; color: #4CAF50;">
                    A new verification link has been sent to the email address you provided during registration.
                </div>
            @endif

            <!-- Forms for Resend and Logout -->
            <div style="display: flex; justify-content: space-between; margin-top: 30px;">
                <!-- Resend Verification Email Form -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <div>
                        <x-primary-button
                            style="background-color: #003a27; color: white; padding: 10px 20px; font-size: 14px; border-radius: 8px;">
                            Resend Verification Email
                        </x-primary-button>
                    </div>
                </form>

                <!-- Log Out Form -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        style="font-size: 14px; color: #003a27; text-decoration: none; background: none; border: none; cursor: pointer; padding: 10px;">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
