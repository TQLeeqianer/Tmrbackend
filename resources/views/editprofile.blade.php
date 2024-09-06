@extends('layout.app')

@section('content')
<style>
    .container {
        max-width: 500px;
        margin: 50px auto;
        padding: 30px;
        background-color: #2c3e50;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        color: #ecf0f1;
    }

    h2 {
        font-size: 24px;
        margin-bottom: 25px;
        text-align: center;
        color: #ecf0f1;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
        color: #ecf0f1;
    }

    .form-control {
        background-color: #1a252f;
        border: 1px solid #7f8c8d;
        color: #ecf0f1;
        padding: 10px;
        font-size: 14px;
        border-radius: 5px;
    }

    .form-control:focus {
        background-color: #2c3e50;
        border-color: #3498db;
    }

    .btn-primary {
        background-color: #2980b9;
        border-color: #2980b9;
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #3498db;
    }

    .alert-success {
        background-color: #27ae60;
        color: #ecf0f1;
        border-color: #27ae60;
        text-align: center;
        margin-bottom: 20px;
        border-radius: 5px;
        padding: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .invalid-feedback {
        color: #e74c3c;
    }

    input.is-invalid {
        border-color: #e74c3c;
    }
</style>

<div class="container">
    <h2>Change Password</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('updatePassword') }}" method="POST">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="current_password">Current Password</label>
            <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
            @error('current_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" required>
            @error('new_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="new_password_confirmation">Confirm New Password</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
</div>
@endsection
