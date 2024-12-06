<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gymplanner"; // Nama database yang digunakan

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah permintaan menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil ID jadwal dari data POST
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $scheduleId = intval($_POST['id']);

        // Gunakan prepared statement untuk menghapus data
        $stmt = $conn->prepare("DELETE FROM schedules WHERE id = ?");
        $stmt->bind_param("i", $scheduleId);

        if ($stmt->execute()) {
            // Kirim respon JSON jika berhasil
            echo json_encode(['success' => true]);
        } else {
            // Kirim respon JSON jika gagal
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }

        $stmt->close();
    } else {
        // Kirim respon JSON jika ID tidak valid
        echo json_encode(['success' => false, 'error' => 'Invalid ID']);
    }
} else {
    // Kirim respon JSON jika metode tidak valid
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

// Menutup koneksi database
$conn->close();
?>
