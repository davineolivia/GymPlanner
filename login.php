<?php
// Mulai session
session_start();

// Cek apakah pengguna sudah login, jika sudah redirect ke dashboard
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

// Simulasi data pengguna (Anda bisa mengganti ini dengan database)
$users = [
    'akaliezter' => '290405',
    'fitlover' => 'gym2024'
];

// Variabel untuk menampilkan pesan error
$error_message = '';

// Proses form jika metode POST digunakan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validasi input kosong
    if (empty($username) || empty($password)) {
        $error_message = 'Username or Password cannot be empty!';
    } elseif (!isset($users[$username]) || $users[$username] !== $password) {
        // Validasi username dan password dengan data pengguna
        $error_message = 'Incorrect Username or Password!';
    } else {
        // Jika validasi berhasil, buat session dan redirect ke dashboard
        $_SESSION['user'] = $username;
        header('Location: dashboard.php');
        exit;
    }
}

// Jika ada cookie, set session secara otomatis
if (isset($_COOKIE['username'])) {
    $_SESSION['user'] = $_COOKIE['username'];
    header('Location: dashboard.php');
    exit;
}
?>

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
    <!-- Menambahkan JavaScript -->
    <script>
        // Function to validate login form
        function validateForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var errorMessage = document.getElementById("error-message");

            // Clear previous error messages
            errorMessage.innerHTML = '';

            // Validate if username or password is empty
            if (username === '' || password === '') {
                errorMessage.innerHTML = 'Username or Password cannot be empty!';
                errorMessage.style.color = 'red';
                return false;
            }

            // You can add more client-side validations if needed
            return true;
        }
    </script>
</head>

<body>
    <div class="container">
        <a href="index.php" class="back-home">Home</a>
        <div class="login-card">
            <div class="image-section">
                <img src="img/image1.png" alt="Couple of BodyShapers" class="login-image">
            </div>
            <div class="login-section">
                <h1>Welcome Back, <br> BodyShapers</h1>
                <p>Ready to crush your goals again?</p>
                <!-- Form login -->
                <form method="POST" action="" onsubmit="return validateForm()">
                    <input type="text" id="username" name="username" placeholder="Username" class="login-input" required>
                    <input type="password" id="password" name="password" placeholder="Password" class="login-input" required>
                    <button type="submit" class="login-button">Log Me In</button>
                </form>
                <!-- Link untuk membuat akun -->
                <p class="create-account">
                    Is this the first time for you? <a href="register.php">Create New Account</a>
                </p>
                <!-- Pesan error -->
                <?php if ($error_message): ?>
                    <p id="error-message" style="color: rgb(255, 116, 116);">
                        <?= htmlspecialchars($error_message) ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>
