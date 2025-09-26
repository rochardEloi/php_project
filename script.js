// DOM Content Loaded
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            if (targetSection) {
                targetSection.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Add loading animation to forms
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"], input[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Processing...';
            }
        });
    });

    // Password strength indicator for registration
    const passwordInput = document.querySelector('input[name="password"]');
    const confirmPasswordInput = document.querySelector('input[name="confirm_password"]');

    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const strength = checkPasswordStrength(password);

            const strengthIndicator = document.querySelector('.password-strength');
            if (strengthIndicator) {
                strengthIndicator.className = 'password-strength ' + strength.level;
                strengthIndicator.textContent = strength.message;
            }
        });
    }

    // Password confirmation validation
    if (confirmPasswordInput && passwordInput) {
        confirmPasswordInput.addEventListener('input', function() {
            const password = passwordInput.value;
            const confirmPassword = this.value;

            const matchIndicator = document.querySelector('.password-match');
            if (matchIndicator) {
                if (password === confirmPassword && confirmPassword !== '') {
                    matchIndicator.textContent = 'Passwords match ✓';
                    matchIndicator.className = 'password-match match';
                } else if (confirmPassword !== '') {
                    matchIndicator.textContent = 'Passwords do not match ✗';
                    matchIndicator.className = 'password-match no-match';
                } else {
                    matchIndicator.textContent = '';
                }
            }
        });
    }

    // Mobile menu toggle (if needed)
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function() {
            const navMenu = document.querySelector('.nav-menu');
            navMenu.classList.toggle('active');
        });
    }
});

// Password strength checker
function checkPasswordStrength(password) {
    let strength = 0;
    let message = '';
    let level = '';

    if (password.length >= 8) strength++;
    if (password.match(/[a-z]/)) strength++;
    if (password.match(/[A-Z]/)) strength++;
    if (password.match(/[0-9]/)) strength++;
    if (password.match(/[^a-zA-Z0-9]/)) strength++;

    switch (strength) {
        case 0:
        case 1:
            message = 'Very Weak';
            level = 'very-weak';
            break;
        case 2:
            message = 'Weak';
            level = 'weak';
            break;
        case 3:
            message = 'Fair';
            level = 'fair';
            break;
        case 4:
            message = 'Good';
            level = 'good';
            break;
        case 5:
            message = 'Strong';
            level = 'strong';
            break;
    }

    return { strength, message, level };
}

// Utility function to show messages
function showMessage(message, type = 'info') {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${type}`;
    messageDiv.textContent = message;

    const container = document.querySelector('.container') || document.body;
    container.insertBefore(messageDiv, container.firstChild);

    // Auto remove after 5 seconds
    setTimeout(() => {
        messageDiv.remove();
    }, 5000);
}

// Form validation helper
function validateForm(form) {
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('error');
            isValid = false;
        } else {
            input.classList.remove('error');
        }

        // Email validation
        if (input.type === 'email' && input.value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(input.value)) {
                input.classList.add('error');
                isValid = false;
            }
        }
    });

    return isValid;
}
