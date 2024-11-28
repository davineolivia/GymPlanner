<?php
// Start session
session_start();

// Menghapus semua data session
$_SESSION = array();

// Jika menggunakan cookie, hapus cookie yang terkait dengan session
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Hapus cookie 'username' yang digunakan untuk mengingat login pengguna
if (isset($_COOKIE['username'])) {
    setcookie('username', '', time() - 3600, '/'); // Menghapus cookie 'username'
}

// Hancurkan session
session_destroy();

// Redirect ke halaman login setelah logout
header("Location: login.php");
exit;
?>
