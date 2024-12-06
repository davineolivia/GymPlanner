<?php
require 'vendor/autoload.php'; // Pastikan autoload Dompdf sudah terkonfigurasi

use Dompdf\Dompdf;

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gymplanner";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data jadwal dari database
$sql = "SELECT * FROM schedules";
$result = $conn->query($sql);

// Inisialisasi Dompdf
$dompdf = new Dompdf();

// Bangun HTML untuk PDF
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Schedule List</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Activity</th>
                <th>Focus</th>
                <th>Location</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>';

if ($result->num_rows > 0) {
    $index = 1;
    while ($row = $result->fetch_assoc()) {
        $html .= '
            <tr>
                <td>' . $index++ . '</td>
                <td>' . htmlspecialchars($row['activity']) . '</td>
                <td>' . htmlspecialchars($row['focus']) . '</td>
                <td>' . htmlspecialchars($row['location']) . '</td>
                <td>' . date("d/m/Y", strtotime($row['date'])) . '</td>
                <td>' . date("H:i", strtotime($row['time'])) . '</td>
            </tr>';
    }
} else {
    $html .= '<tr><td colspan="6">No schedules available</td></tr>';
}

$html .= '
        </tbody>
    </table>
</body>
</html>';

// Generate PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Output PDF ke browser
$dompdf->stream("schedule.pdf", ["Attachment" => false]);
exit;
?>
