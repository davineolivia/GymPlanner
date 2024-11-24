<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Manjari:wght@100;400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/register-styles.css">
</head>

<body>
    <div id="warning-message" class="warning-message" style="display: none;">
        <p>You have previously registered. Do you want to <a href="login.html">Log In</a> with your existing account or
            <a href="javascript:void(0);" id="create-new-account">Create New Account</a>
        </p>
    </div>

    <div class="container">
        <a href="index.html" class="back-home">Home</a>
        <a href="login.html" class="back-login">Login</a>
        <div class="register-card" id="register-card">
            <!-- Bagian kiri -->
            <div class="left-section">
                <img src="img/logo.png" alt="GymPlanner Best Logo" class="register-logo">
                <h1>Let’s Create New Account</h1>
                <p>Before you're ready to achieve your goals, let us know a bit about you, BodyShaper!</p>
            </div>
            <!-- Bagian kanan -->
            <div class="right-section">
                <form id="register-form">
                    <input type="text" placeholder="Full Name" class="register-input" id="full-name" required>
                    <input type="email" placeholder="Email Address" class="register-input" id="email" required>
                    <input type="password" placeholder="Password" class="register-input" id="password" required>
                    <input type="password" placeholder="Confirm Password" class="register-input" id="confirm-password"
                        required>
                    <button type="submit" class="register-button">Create My Account</button>
                </form>
                <p class="already-account">
                    Already have an account? <a href="login.html">Log In</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Check if data exists in localStorage for previously registered user
        if (localStorage.getItem('userRegistered') === 'true') {
            document.getElementById('warning-message').style.display = 'block';
            document.getElementById('register-card').style.display = 'none';
        }

        // Handle "Create New Account" click
        document.getElementById('create-new-account').addEventListener('click', function () {
            // Clear localStorage if user wants to create a new account
            localStorage.removeItem('userRegistered');
            // Show register card again with empty fields
            document.getElementById('register-card').style.display = 'flex';
            document.getElementById('warning-message').style.display = 'none';
            document.getElementById('register-form').reset(); // Reset form fields
        });

        // Handle form submission
        document.getElementById('register-form').addEventListener('submit', function (event) {
            event.preventDefault();
            // Assuming the registration is successful, set the localStorage flag
            localStorage.setItem('userRegistered', 'true');
            alert('Registration Successful!'); // Add logic for successful registration
        });
    </script>
</body>

</html>