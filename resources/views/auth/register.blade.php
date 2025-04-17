@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4 border-0">
                <div class="card-header bg-primary text-white fs-4 fw-bold text-center rounded-top-4">
                    Create Your Account
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input id="name" type="text" class="form-control rounded-pill" name="name" required autofocus>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input id="email" type="email" class="form-control rounded-pill" name="email" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control rounded-pill" name="password" required>
                            </div>

                            <div class="col-md-6">
                                <label for="password-confirm" class="form-label">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control rounded-pill" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Register As</label>
                            <select name="role" class="form-select rounded-pill" required>
                                <option value="">Choose Role</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control rounded-pill">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select rounded-pill">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">State</label>
                            <select name="state" id="state" class="form-select rounded-pill">
                                <option value="">Select State</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                            <label class="form-label">District</label>
                            <select name="district" id="district" class="form-select rounded-pill">
                                <option value="">Select District</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <select name="city" id="city" class="form-select rounded-pill">
                                <option value="">Select City</option>
                            </select>
                        </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success rounded-pill py-2 fs-5">
                                Register
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        Already registered?
                        <a href="{{ route('login') }}" class="text-decoration-none fw-bold text-primary">Login here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#state').on('change', function () {
        var stateID = $(this).val();
        if (stateID) {
            $.get('/get-districts/' + stateID, function (data) {
                $('#district').empty().append('<option value="">Select District</option>');
                $.each(data, function (key, value) {
                    $('#district').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
                $('#city').empty().append('<option value="">Select City</option>');
            });
        }
    });

    $('#district').on('change', function () {
        var districtID = $(this).val();
        if (districtID) {
            $.get('/get-cities/' + districtID, function (data) {
                $('#city').empty().append('<option value="">Select City</option>');
                $.each(data, function (key, value) {
                    $('#city').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            });
        }
    });
</script>

@endsection

