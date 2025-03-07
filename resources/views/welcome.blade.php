@php use Illuminate\Support\Facades\Route; @endphp
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4"
                           :status="session('status')" />

    <div class="row authentication authentication-cover-main mx-0" style="background: linear-gradient(rgba(0, 0, 150, 0.7), rgba(0, 0, 150, 0.7)), url('/assets/images/media/backgrounds/machinery.jpg') center/cover no-repeat;">
        <div class="col-xxl-6 col-xl-7">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-xxl-7 col-xl-9 col-lg-6 col-md-6 col-sm-8 col-12">
                    <div class="card custom-card my-auto border">
                        <div class="card-body p-5">
                            <p class="h5 mb-2 text-center">Sign In</p>
                            <p class="text-muted op-7 fw-normal mb-4 text-center">Welcome back! Please login to your
                                account.</p>

                            <!-- Display Authentication Errors -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif



                            <!-- Fingerprint Authentication -->
                            <div class="d-flex justify-content-between flex-lg-nowrap mb-3 flex-wrap gap-2">
                                <button class="btn btn-lg btn-primary d-flex align-items-center justify-content-center flex-fill" id="biometric-scan-btn">
                                    <span class="avatar avatar-xs flex-shrink-0">
                                        <i class="ri-fingerprint-line fs-20"></i>
                                    </span>
                                    <span class="lh-1 fs-13 text-white ms-2">Sign In with Fingerprint</span>
                                </button>
                            </div>

                            <!-- OR divider -->
                            <div class="authentication-barrier my-3 text-center">
                                <span>OR</span>
                            </div>

                            <!-- Login Form -->
                            <form method="POST"
                                  action="{{ route('login') }}"
                                  id="login-form"
                                  class="needs-validation"
                                  novalidate>
                                @csrf
                                <div class="row gy-3">
                                    <div class="col-xl-12">
                                        <label for="email" class="form-label mb-1">Email</label>
                                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                               id="email" name="email" value="{{ old('email') }}" required autofocus>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-xl-12 mb-2">
                                        <label for="password" class="form-label mb-1">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" required>
                                            <button class="btn btn-light" type="button" id="togglePassword" aria-label="Toggle password visibility">
                                                <i class="fas fa-eye" id="toggleIcon"></i>
                                            </button>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                                <label class="form-check-label" for="remember">Remember me</label>
                                            </div>
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" class="text-primary fw-semibold fs-13">Forgot Password?</a>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg w-100">Sign In</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

<!-- Biometric Fingerprint Validation Modal -->
<div id="biometric-validation-modal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Biometric Authentication</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-4">
                    <i class="fas fa-fingerprint fa-4x text-primary mb-3"></i>
                    <p class="mb-2">Please scan your fingerprint for authentication</p>
                    <div id="fingerprint-status" class="text-muted"></div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="BiometricAuth.startAuthentication()">Try Again</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add the necessary JavaScript -->
<script src="{{ asset('assets/js/biometric-auth.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // OPTIMIZE: Open the biometric scan modal automatically when the page loads
        var modal = new bootstrap.Modal(document.getElementById('biometric-validation-modal'));
        modal.show();

        // OPTIMIZE: Simulate the biometric scan (replace with actual fingerprint API logic)
        startBiometricScan();

        function startBiometricScan() {
            document.getElementById('fingerprint-status').innerText = "Scanning..."; // Initial status

            fetch('/biometric/scan')
                .then(response => response.json())
                .then(data => {
                    // SECURITY: Check if fingerprintData is present to avoid errors
                    if (!data.fingerprintData) {
                        console.error('Fingerprint scan failed: No fingerprint data received.');
                        document.getElementById('fingerprint-status').innerText = 'Error during scan.';
                        return;
                    }

                    // OPTIMIZE: Simulate fingerprint data processing (replace with actual logic)
                    document.getElementById('fingerprint-status').innerText = "Validating...";
                    setTimeout(function() {
                        // SECURITY: Ensure the fingerprintData is passed securely
                        fetch('/biometric/validate', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute(
                                        'content') // Required for CSRF protection
                                },
                                body: JSON.stringify({
                                    fingerprints: [data.fingerprintData]
                                })
                            })
                            .then(response => response.json())
                            .then(result => {
                                if (result.success) {
                                    document.getElementById('fingerprint-status').innerText =
                                        "Authentication successful!";
                                    // OPTIMIZE: On success, submit the form
                                    document.getElementById('login-form').submit();
                                } else {
                                    // OPTIMIZE: On failure, show an error message
                                    document.getElementById('fingerprint-status').innerText =
                                        'Fingerprint validation failed.';
                                }
                            })
                            .catch(error => {
                                console.error("Biometric validation error:", error);
                                document.getElementById('fingerprint-status').innerText =
                                    "Validation error.";
                            });
                    }, 3000); // Simulate scanning time
                })
                .catch(error => {
                    console.error("Fingerprint scanning error:", error);
                    document.getElementById('fingerprint-status').innerText = "Scanning error.";
                });
        }
    });
</script>
<!-- Add this script at the end of the file -->
<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<style>
    .hover-effect {
        transition: all 0.3s ease;
    }
    .hover-effect:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .animate__animated {
        animation-duration: 1s;
    }
    .btn-content {
        transition: transform 0.3s ease;
    }
    .btn:hover .btn-content {
        transform: scale(1.05);
    }
    .authentication-barrier {
        position: relative;
        text-align: center;
        margin: 20px 0;
    }
    .authentication-barrier span {
        position: relative;
        padding: 0 10px;
        background: white;
        z-index: 1;
    }
    .authentication-barrier:before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        height: 1px;
        background: #e0e0e0;
        z-index: 0;
    }
    .show-password-button {
        cursor: pointer;
        padding: 10px;
        z-index: 2;
    }
    .show-password-button i {
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const toggleButton = document.querySelector('.show-password-button');

    if (toggleButton && passwordInput) {
        toggleButton.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type');
            passwordInput.setAttribute('type', type === 'password' ? 'text' : 'password');

            const icon = toggleButton.querySelector('i');
            if (icon) {
                icon.classList.toggle('ri-eye-line');
                icon.classList.toggle('ri-eye-off-line');
            }
        });
    }
});
</script>
