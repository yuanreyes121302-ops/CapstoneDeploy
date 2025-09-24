@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

    main.py-4 {
        padding: 0 !important;
        background: #f7f7f7 !important;
        min-height: calc(100vh - 56px) !important;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .register-container {
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
        padding: 1rem;
    }

    .register-card {
        background: #fff;
        border-radius: 12px;
        padding: 2rem;
        border: 1px solid #e0e0e0;
    }

    .register-header {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .logo-icon {
        width: 60px;
        height: 60px;
        background: #c83232;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .logo-icon i {
        color: #fff;
        font-size: 28px;
    }

    .register-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.3rem;
    }

    .register-subtitle {
        font-size: 0.9rem;
        color: #666;
    }

    .register-form {
        display: grid;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .form-floating {
        position: relative;
    }

    .form-floating input,
    .form-floating select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 0.95rem;
        font-family: 'Poppins', sans-serif;
    }

    .form-floating label {
        font-size: 0.85rem;
        color: #555;
        margin-bottom: 0.3rem;
        display: block;
    }

    .input-icon,
    .password-toggle {
        display: none; /* removed icons for simpler look */
    }

    .btn-submit {
        width: 100%;
        padding: 0.9rem;
        font-family: 'Poppins', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        color: #fff;
        background: #c83232;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-submit:hover {
        background: #a82828;
    }

    .signin-section {
        text-align: center;
        margin-top: 1rem;
    }

    .signin-text {
        font-size: 0.9rem;
        color: #555;
    }

    .signin-link {
        color: #c83232;
        font-weight: 600;
        margin-left: 0.3rem;
        text-decoration: none;
    }

    .signin-link:hover {
        text-decoration: underline;
    }

    .alert-success {
        background: #e6f4ea;
        border: 1px solid #c8e6c9;
        color: #2e7d32;
        padding: 0.8rem;
        border-radius: 8px;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }
</style>

<div class="register-container">
    <div class="register-card">
        <!-- Header -->
        <div class="register-header">
            <div class="logo-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1 class="register-title">Create Account</h1>
            <p class="register-subtitle">Join us and start your journey today</p>
        </div>

        <!-- Success Message -->
        @if (session('status'))
            <div class="alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- Registration Form -->
        <form method="POST" action="{{ route('register') }}" id="registerForm" class="register-form">
            @csrf

            <!-- First Name -->
            <div class="form-floating">
                <label for="first_name">First Name</label>
                <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus>
            </div>

            <!-- Last Name -->
            <div class="form-floating">
                <label for="last_name">Last Name</label>
                <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required>
            </div>

            <!-- Email -->
            <div class="form-floating">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- User ID -->
            <div class="form-floating">
                <label for="user_id">User ID</label>
                <input id="user_id" type="text" name="user_id" value="{{ old('user_id') }}" required>
                @error('user_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Gender -->
            <div class="form-floating">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value=""></option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <!-- Role -->
            <div class="form-floating">
                <label for="role">Register As</label>
                <select id="role" name="role" required>
                    <option value=""></option>
                    <option value="tenant" {{ old('role') == 'tenant' ? 'selected' : '' }}>Tenant</option>
                    <option value="landlord" {{ old('role') == 'landlord' ? 'selected' : '' }}>Landlord</option>
                </select>
            </div>

            <!-- Contact Number -->
            <div class="form-floating" id="contact-number-field" style="display: none;">
                <label for="contact_number">Contact Number</label>
                <input id="contact_number" type="text" name="contact_number" value="{{ old('contact_number') }}">
                @error('contact_number')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-floating">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-floating">
                <label for="password-confirm">Confirm Password</label>
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-submit" id="submitBtn">
                Create Account
            </button>
        </form>

        <!-- Sign In Link -->
        <div class="signin-section">
            <span class="signin-text">Already have an account?</span>
            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="signin-link">Sign In</a>
            @endif
        </div>
    </div>
</div>
@endsection
