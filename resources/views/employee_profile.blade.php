@extends('layout.employee_master')

@section('title', 'Profile')

@section('content')

<body>
    <style>
        /* Custom CSS to ensure label visibility */
        .form-label {
            color: #000 !important; /* Set label text color to black */
        }
    </style>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">User Profile</div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label for="firstName" class="form-label">First Name</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="firstname" value="{{ Auth::user()->firstname }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label for="lastName" class="form-label">Last Name</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="lastname" value="{{ Auth::user()->lastname }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label for="validId" class="form-label">Valid ID</label>
                            </div>
                            <div class="col-md-8">
                                <img src="{{ asset('storage/images/employeeprofile.png')}}" alt="User Image" class="img-fluid"> <!-- Use Bootstrap's img-fluid class for responsive images -->
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label for="email" class="form-label">Email</label>
                            </div>
                            <div class="col-md-8">
                                <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                            </div>
                            <div class="col-md-8">
                                <input type="tel" class="form-control" id="contactnumber" value="{{ Auth::user()->contact }}" readonly>
                            </div>
                        </div>

                        <!-- Change Password Button -->
                        <div class="mb-3">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">                    
                <form id="passwordForm" method="POST" action="{{ route('password.action') }}">
    @csrf
    <div class="mb-3">
        <label for="currentPassword" class="form-label">Current Password</label>
        <div class="input-group">
            <input id="currentPassword" class="form-control" type="password" name="old_password" />
            <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('currentPassword')">Show</button>
        </div>
    </div>
    <div class="mb-3">
        <label for="newPassword" class="form-label">New Password</label>
        <div class="input-group">
            <input id="newPassword" class="form-control" type="password" name="new_password" />
            <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('newPassword')">Show</button>
        </div>
    </div>
    <div class="mb-3">
        <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
        <div class="input-group">
            <input id="confirmNewPassword" class="form-control" type="password" name="new_password_confirmation" />
            <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('confirmNewPassword')">Show</button>
        </div>
    </div>
    <button type="submit" class="btn btn-primary" onclick="showSuccessMessage()">Save Changes</button>
</form>

<script>
    function showSuccessMessage() {
        alert("Password Changes Successfully");
    }
</script>
</div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function togglePasswordVisibility(inputId) {
        var passwordInput = document.getElementById(inputId);
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }

    
    document.addEventListener('DOMContentLoaded', function () {
        var indicator = document.getElementById('nav-indicator');
        var activeLink = document.querySelector('.side-menu a.active');
        if (activeLink) {
            var linkRect = activeLink.getBoundingClientRect();
            indicator.innerHTML = activeLink.textContent;
            indicator.style.width = linkRect.width + 'px';
            indicator.style.left = linkRect.left + 'px';
        }
    });
</script>
    
</body>
@endsection
