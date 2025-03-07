/**
 * Biometric Authentication JavaScript
 * Handles client-side biometric operations for fingerprint enrollment and authentication
 */

const BiometricAuth = {
    // Configuration
    config: {
        scanEndpoint: '/biometric/scan',
        validateEndpoint: '/biometric/validate',
        enrollEndpoint: '/biometric/enroll',
        removeEndpoint: '/biometric/remove',
        csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
    },

    /**
     * Initialize the biometric authentication system
     */
    init: function() {
        // Check if browser supports Web Authentication API
        if (!window.PublicKeyCredential) {
            console.error('Web Authentication API is not supported in this browser');
            return false;
        }

        // Attach event listeners
        this.attachEventListeners();
        return true;
    },

    /**
     * Attach event listeners to biometric buttons
     */
    attachEventListeners: function() {
        // Enrollment buttons
        document.querySelectorAll('.biometric-enroll-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const keyIndex = e.target.dataset.keyIndex || 1;
                this.startEnrollment(keyIndex);
            });
        });

        // Authentication buttons
        document.querySelectorAll('.biometric-auth-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                this.startAuthentication();
            });
        });

        // Remove fingerprint buttons
        document.querySelectorAll('.biometric-remove-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const keyIndex = e.target.dataset.keyIndex || 1;
                this.removeFingerprint(keyIndex);
            });
        });
    },

    /**
     * Start the fingerprint enrollment process
     * @param {number} keyIndex - Index of the fingerprint (1-3)
     */
    startEnrollment: async function(keyIndex) {
        try {
            // Show loading indicator
            this.showLoading('Initializing fingerprint enrollment...');

            // Get challenge from server
            const response = await fetch(this.config.scanEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.config.csrfToken
                }
            });

            if (!response.ok) {
                throw new Error('Failed to initialize enrollment');
            }

            const data = await response.json();
            if (!data.success) {
                throw new Error(data.message || 'Failed to initialize enrollment');
            }

            // Prompt user for fingerprint
            await this.captureFingerprint(data.challenge, keyIndex);

            // Show success message
            this.showSuccess('Fingerprint enrolled successfully!');
        } catch (error) {
            console.error('Enrollment error:', error);
            this.showError(error.message || 'Failed to enroll fingerprint');
        } finally {
            this.hideLoading();
        }
    },

    /**
     * Capture fingerprint data using the device's biometric sensor
     * @param {string} challenge - Server-generated challenge
     * @param {number} keyIndex - Index of the fingerprint (1-3)
     */
    captureFingerprint: async function(challenge, keyIndex) {
        try {
            // In a real implementation, this would use the Web Authentication API
            // For this example, we'll simulate fingerprint capture
            this.showLoading('Place your finger on the sensor...');
            
            // Simulate fingerprint scanning delay
            await new Promise(resolve => setTimeout(resolve, 2000));
            
            // Generate a simulated fingerprint hash
            // In a real implementation, this would be actual biometric data
            const fingerprintData = this.simulateFingerprintCapture(challenge);
            
            // Send the fingerprint data to the server
            const response = await fetch(this.config.enrollEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.config.csrfToken
                },
                body: JSON.stringify({
                    fingerprint_data: fingerprintData,
                    key_index: keyIndex
                })
            });

            if (!response.ok) {
                throw new Error('Failed to enroll fingerprint');
            }

            const data = await response.json();
            if (!data.success) {
                throw new Error(data.message || 'Failed to enroll fingerprint');
            }

            return data;
        } catch (error) {
            console.error('Capture error:', error);
            throw new Error('Failed to capture fingerprint: ' + error.message);
        }
    },

    /**
     * Start the authentication process using fingerprint
     */
    startAuthentication: async function() {
        try {
            // Show loading indicator
            this.showLoading('Initializing fingerprint authentication...');

            // Get challenge from server
            const response = await fetch(this.config.scanEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.config.csrfToken
                }
            });

            if (!response.ok) {
                throw new Error('Failed to initialize authentication');
            }

            const data = await response.json();
            if (!data.success) {
                throw new Error(data.message || 'Failed to initialize authentication');
            }

            // Get user email (in a real app, this might be from a form)
            const email = document.querySelector('#email')?.value || '';
            if (!email) {
                throw new Error('Email is required for authentication');
            }

            // Simulate fingerprint capture
            this.showLoading('Place your finger on the sensor...');
            await new Promise(resolve => setTimeout(resolve, 2000));
            const fingerprintData = this.simulateFingerprintCapture(data.challenge);

            // Validate fingerprint with server
            const validateResponse = await fetch(this.config.validateEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.config.csrfToken
                },
                body: JSON.stringify({
                    fingerprints: [fingerprintData],
                    email: email
                })
            });

            if (!validateResponse.ok) {
                throw new Error('Authentication failed');
            }

            const validateData = await validateResponse.json();
            if (!validateData.success) {
                throw new Error(validateData.message || 'Authentication failed');
            }

            // Authentication successful
            this.showSuccess('Authentication successful! Redirecting...');
            setTimeout(() => {
                window.location.href = '/dashboard';
            }, 1500);

        } catch (error) {
            console.error('Authentication error:', error);
            this.showError(error.message || 'Authentication failed');
        } finally {
            this.hideLoading();
        }
    },

    /**
     * Remove a stored fingerprint
     * @param {number} keyIndex - Index of the fingerprint to remove (1-3)
     */
    removeFingerprint: async function(keyIndex) {
        try {
            // Show loading indicator
            this.showLoading('Removing fingerprint...');

            // Send request to remove fingerprint
            const response = await fetch(this.config.removeEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.config.csrfToken
                },
                body: JSON.stringify({
                    key_index: keyIndex
                })
            });

            if (!response.ok) {
                throw new Error('Failed to remove fingerprint');
            }

            const data = await response.json();
            if (!data.success) {
                throw new Error(data.message || 'Failed to remove fingerprint');
            }

            // Show success message
            this.showSuccess('Fingerprint removed successfully!');
            
            // Update UI to reflect removal
            const fingerprintIndicator = document.querySelector(`.fingerprint-indicator[data-key-index="${keyIndex}"]`);
            if (fingerprintIndicator) {
                fingerprintIndicator.classList.remove('enrolled');
                fingerprintIndicator.classList.add('not-enrolled');
            }

        } catch (error) {
            console.error('Remove fingerprint error:', error);
            this.showError(error.message || 'Failed to remove fingerprint');
        } finally {
            this.hideLoading();
        }
    },

    /**
     * Simulate fingerprint capture (for demonstration purposes)
     * In a real implementation, this would use the Web Authentication API
     * @param {string} challenge - Server-generated challenge
     * @returns {string} - Simulated fingerprint data
     */
    simulateFingerprintCapture: function(challenge) {
        // This is just a simulation - in a real app, this would be actual biometric data
        const randomBytes = new Uint8Array(32);
        window.crypto.getRandomValues(randomBytes);
        const fingerprintData = Array.from(randomBytes)
            .map(b => b.toString(16).padStart(2, '0'))
            .join('');
        
        return challenge + ':' + fingerprintData;
    },

    /**
     * Show loading indicator
     * @param {string} message - Loading message to display
     */
    showLoading: function(message) {
        // Create or update loading element
        let loadingEl = document.getElementById('biometric-loading');
        if (!loadingEl) {
            loadingEl = document.createElement('div');
            loadingEl.id = 'biometric-loading';
            loadingEl.className = 'biometric-overlay';
            document.body.appendChild(loadingEl);
        }

        loadingEl.innerHTML = `
            <div class="biometric-loading-content">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p>${message || 'Processing...'}</p>
            </div>
        `;
        loadingEl.style.display = 'flex';
    },

    /**
     * Hide loading indicator
     */
    hideLoading: function() {
        const loadingEl = document.getElementById('biometric-loading');
        if (loadingEl) {
            loadingEl.style.display = 'none';
        }
    },

    /**
     * Show success message
     * @param {string} message - Success message to display
     */
    showSuccess: function(message) {
        // Create toast notification
        const toastId = 'biometric-toast-' + Date.now();
        const toastHtml = `
            <div id="${toastId}" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="ri-check-line me-2"></i> ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;
        
        // Add toast to container or create one
        let toastContainer = document.querySelector('.toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            document.body.appendChild(toastContainer);
        }
        
        toastContainer.insertAdjacentHTML('beforeend', toastHtml);
        
        // Initialize and show toast
        const toastEl = document.getElementById(toastId);
        const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();
    },

    /**
     * Show error message
     * @param {string} message - Error message to display
     */
    showError: function(message) {
        // Create toast notification
        const toastId = 'biometric-toast-' + Date.now();
        const toastHtml = `
            <div id="${toastId}" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="ri-error-warning-line me-2"></i> ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;
        
        // Add toast to container or create one
        let toastContainer = document.querySelector('.toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            document.body.appendChild(toastContainer);
        }
        
        toastContainer.insertAdjacentHTML('beforeend', toastHtml);
        
        // Initialize and show toast
        const toastEl = document.getElementById(toastId);
        const toast = new bootstrap.Toast(toastEl, { delay: 5000 });
        toast.show();
    }
};

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    BiometricAuth.init();
});