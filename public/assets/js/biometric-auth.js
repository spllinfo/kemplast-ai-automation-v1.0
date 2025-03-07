/**
 * Biometric Authentication Module
 */
const BiometricAuth = {
    // Check if the browser supports biometric authentication
    isSupported() {
        return window.PublicKeyCredential &&
            typeof window.PublicKeyCredential === 'function' &&
            typeof window.PublicKeyCredential.isUserVerifyingPlatformAuthenticatorAvailable === 'function';
    },

    // Initialize biometric authentication
    async init() {
        try {
            const isSupported = await this.isSupported();
            if (!isSupported) {
                console.warn('Biometric authentication is not supported on this device.');
                return false;
            }

            const biometricButton = document.getElementById('biometric-scan-btn');
            if (biometricButton) {
                biometricButton.style.display = 'inline-block';
                biometricButton.addEventListener('click', () => this.startAuthentication());
            }

            return true;
        } catch (error) {
            console.error('Error initializing biometric authentication:', error);
            return false;
        }
    },

    // Start the authentication process
    async startAuthentication() {
        try {
            const email = document.getElementById('email').value;
            if (!email) {
                throw new Error('Please enter your email address first.');
            }

            // Update status
            const statusElement = document.getElementById('fingerprint-status');
            if (statusElement) statusElement.innerText = 'Starting biometric scan...';

            // Initialize scan
            const scanResponse = await fetch('/biometric/scan');
            const scanData = await scanResponse.json();

            if (!scanData.success) {
                throw new Error(scanData.message || 'Failed to initialize biometric scan');
            }

            // Request fingerprint
            const credential = await navigator.credentials.get({
                publicKey: {
                    challenge: this.base64ToArrayBuffer(scanData.challenge),
                    timeout: 60000,
                    userVerification: 'required',
                    rpId: window.location.hostname
                }
            });

            // Validate fingerprint
            if (statusElement) statusElement.innerText = 'Validating...';

            const validationResponse = await fetch('/biometric/validate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    email: email,
                    fingerprints: [this.arrayBufferToBase64(credential.response.userHandle)]
                })
            });

            const validationResult = await validationResponse.json();

            if (validationResult.success) {
                if (statusElement) statusElement.innerText = 'Authentication successful!';
                window.location.href = validationResult.redirect;
            } else {
                throw new Error(validationResult.message || 'Authentication failed');
            }

        } catch (error) {
            console.error('Biometric authentication error:', error);
            const statusElement = document.getElementById('fingerprint-status');
            if (statusElement) {
                statusElement.innerText = error.message || 'Authentication failed';
            }
        }
    },

    // Enroll a new fingerprint
    async enrollFingerprint(keyIndex) {
        try {
            const credential = await navigator.credentials.create({
                publicKey: {
                    challenge: new Uint8Array(32),
                    rp: {
                        name: 'Kemplast Systems',
                        id: window.location.hostname
                    },
                    user: {
                        id: new Uint8Array(16),
                        name: 'user',
                        displayName: 'User'
                    },
                    pubKeyCredParams: [{
                        type: 'public-key',
                        alg: -7
                    }],
                    timeout: 60000,
                    attestation: 'none',
                    authenticatorSelection: {
                        authenticatorAttachment: 'platform',
                        userVerification: 'required'
                    }
                }
            });

            const response = await fetch('/biometric/enroll', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    fingerprint_data: this.arrayBufferToBase64(credential.response.attestationObject),
                    key_index: keyIndex
                })
            });

            const result = await response.json();
            if (!result.success) {
                throw new Error(result.message || 'Failed to enroll fingerprint');
            }

            return result;

        } catch (error) {
            console.error('Error enrolling fingerprint:', error);
            throw error;
        }
    },

    // Remove a stored fingerprint
    async removeFingerprint(keyIndex) {
        try {
            const response = await fetch('/biometric/remove', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ key_index: keyIndex })
            });

            const result = await response.json();
            if (!result.success) {
                throw new Error(result.message || 'Failed to remove fingerprint');
            }

            return result;

        } catch (error) {
            console.error('Error removing fingerprint:', error);
            throw error;
        }
    },

    // Utility: Convert ArrayBuffer to Base64
    arrayBufferToBase64(buffer) {
        const bytes = new Uint8Array(buffer);
        let binary = '';
        for (let i = 0; i < bytes.byteLength; i++) {
            binary += String.fromCharCode(bytes[i]);
        }
        return window.btoa(binary);
    },

    // Utility: Convert Base64 to ArrayBuffer
    base64ToArrayBuffer(base64) {
        const binary = window.atob(base64);
        const bytes = new Uint8Array(binary.length);
        for (let i = 0; i < binary.length; i++) {
            bytes[i] = binary.charCodeAt(i);
        }
        return bytes.buffer;
    }
};

// Initialize biometric authentication when the page loads
document.addEventListener('DOMContentLoaded', () => {
    BiometricAuth.init();
});
