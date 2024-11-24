<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Manjari:wght@100;400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/login-styles.css">
</head>

<body>
    <div class="container">
        <a href="index.html" class="back-home">Home</a>
        <div class="login-card">
            <div class="image-section">
                <img src="img/image1.png" alt="Couple of BodyShapers" class="login-image">
            </div>
            <div class="login-section">
                <h1>Welcome Back, <br> BodyShapers</h1>
                <p>Ready to crush your goals again?</p>
                <form id="loginForm">
                    <input type="text" id="username" placeholder="Username" class="login-input">
                    <input type="password" id="password" placeholder="Password" class="login-input">
                    <button type="submit" class="login-button">Log Me In</button>
                </form>
                <p class="create-account">
                    Is this the first time for you? <a href="register.html">Create New Account</a>
                </p>
                <p id="error-message" style="color: rgb(255, 116, 116); display: none;">Your Input is incorrect. Please try
                    again.</p>
            </div>
        </div>
    </div>

    <script>
        // Get elements
        const form = document.getElementById('loginForm');
        const username = document.getElementById('username');
        const password = document.getElementById('password');
        const errorMessage = document.getElementById('error-message');

        // Form submit event listener
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent form submission to check inputs

            // Regular expression to check the validity of the input (only letters, numbers, '@', and '.')
            const validEmailPattern = /^[a-zA-Z0]+$/;

            // Check if the username and password match the pattern
            if (!validEmailPattern.test(username.value) || !validEmailPattern.test(password.value)) {
                errorMessage.style.display = 'block'; // Show error message
            } else {
                errorMessage.style.display = 'none'; // Hide error message
                // If validation passes, proceed with form submission (or handle the login logic)
                alert('Login successful'); // Replace this with actual login functionality
            }
        });
    </script>
</body>

</html>