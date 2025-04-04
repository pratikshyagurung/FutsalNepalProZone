<x-guest-layout>
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f7fc;">
        <div
            style="max-width: 400px; width: 100%; background-color: #fff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 8px; padding: 30px; text-align: center;">
            <!-- Form Title -->
            <h1 style="font-size: 24px; font-weight: bold; color: #003a27; margin-bottom: 10px;">
                Confirm Your Password
            </h1>

            <!-- Form Description -->
            <p style="font-size: 16px; color: #666; margin-bottom: 20px;">
                Please confirm your password before continuing to the requested page.
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password Field -->
                <div style="margin-bottom: 20px;">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
                    <x-primary-button>
                        {{ __('Confirm') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Link to Login -->
            <div style="margin-top: 20px;">
                <a href="{{ route('login') }}" style="color: #003a27; text-decoration: none; font-size: 14px;">
                    Back to Login
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
