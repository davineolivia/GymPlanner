<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gymplanner";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => "Database connection error: " . $conn->connect_error]));
}

// Tangani form submission dengan POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['activity']) &&
        isset($_POST['focus']) &&
        isset($_POST['location']) &&
        isset($_POST['date']) &&
        isset($_POST['time'])
    ) {
        $activity = trim($_POST['activity']);
        $focus = trim($_POST['focus']);
        $location = trim($_POST['location']);
        $date = $_POST['date'];
        $time = $_POST['time'];

        // Validasi input kosong
        if (empty($activity) || empty($focus) || empty($location) || empty($date) || empty($time)) {
            echo json_encode(['success' => false, 'error' => 'All fields are required']);
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO schedules (activity, focus, location, date, time) VALUES (?, ?, ?, ?, ?)");

        if (!$stmt) {
            die(json_encode(['success' => false, 'error' => $conn->error]));
        }

        $stmt->bind_param("sssss", $activity, $focus, $location, $date, $time);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Schedule successfully added']);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }

        $stmt->close();
        $conn->close();
        exit;
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid POST data']);
    }
}

// Ambil data jadwal untuk ditampilkan
$schedules = [];
$result = $conn->query("SELECT * FROM schedules");

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $schedules[] = $row;
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule - GymPlanner</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/schedule-styles.css">
</head>

<body>
<div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- Logo -->
            <div class="logo">
                <img src="img/logo.png" alt="GymPlanner Logo">
            </div>

            <nav>
                <ul>
                    <li class="active">
                        <a href="Dashboard.php">
                            <img src="img/home.png" alt="Dashboard Icon"> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="schedule.php">
                            <img src="img/schedule.png" alt="Schedule Icon"> Schedule
                        </a>
                    </li>
                    <li>
                        <a href="checklist.php">
                            <img src="img/checklist.png" alt="Checklist Icon"> Checklist
                        </a>
                    </li>
                    <li>
                        <a href="settings.php">
                            <img src="img/settings.png" alt="Settings Icon"> Settings
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <div class="content">
    <h1>Schedule</h1>
    <div class="action-buttons">
        <button id="buttonadd">+ Add Schedule</button>
        <button id="buttonprint">Print Data</button>
    </div>
    
    <!-- Formulir untuk Menambahkan Jadwal -->
    <div class="form-container" id="formContainer" style="display: none;">
        <form id="scheduleForm">
            <label for="activity">Activity:</label>
            <input type="text" id="activity" name="activity" required>
            
            <label for="focus">Focus:</label>
            <input type="text" id="focus" name="focus" required>
            
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
            
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
            
            <label for="time">Time:</label>
            <input type="time" id="time" name="time" required>
            
            <button type="submit">Save</button>
            <button type="button" id="cancelButton">Cancel</button>
        </form>
    </div>

    <!-- Tabel Jadwal -->
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Activity</th>
                <th>Focus</th>
                <th>Location</th>
                <th>Date</th>
                <th>Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="scheduleTableBody">
                <?php if ($schedules && count($schedules) > 0): ?>
                    <?php foreach ($schedules as $index => $schedule): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($schedule['activity']) ?></td>
                            <td><?= htmlspecialchars($schedule['focus']) ?></td>
                            <td><?= htmlspecialchars($schedule['location']) ?></td>
                            <td><?= date("d/m/Y", strtotime($schedule['date'])) ?></td>
                            <td><?= date("H:i", strtotime($schedule['time'])) ?></td>
                            <td><button class="delete-btn" data-id="<?= $schedule['id'] ?>">Delete</button></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No schedules available</td>
                    </tr>
                <?php endif; ?>
            </tbody>
    </table>
</div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const buttonAdd = document.getElementById("buttonadd");
    const buttonPrint = document.getElementById("buttonprint");
    const formContainer = document.getElementById("formContainer");
    const scheduleForm = document.getElementById("scheduleForm");
    const scheduleTableBody = document.getElementById("scheduleTableBody");

    // Tampilkan formulir
    buttonAdd.addEventListener("click", () => formContainer.style.display = "block");

    // Sembunyikan formulir ketika Cancel ditekan
    document.getElementById("cancelButton").addEventListener("click", () => formContainer.style.display = "none");

    // Kirim data formulir dengan AJAX
    scheduleForm.addEventListener("submit", async function (event) {
        event.preventDefault();

        const formData = new FormData(scheduleForm);

        try {
            const response = await fetch('schedule.php', { 
                method: 'POST', 
                body: formData 
            });

            const data = await response.json();
            console.log("Response received: ", data);

            if (data.success) {
                alert("Schedule successfully added!");
                location.reload();
            } else {
                alert("Error: " + (data.error || "Unknown error"));
            }
        } catch (error) {
            console.error("Error sending data: ", error);
            alert("An unexpected error occurred.");
        }
    });

    // Event listener untuk tombol delete
    scheduleTableBody.addEventListener("click", async function (event) {
        if (event.target.classList.contains("delete-btn")) {
            const scheduleId = event.target.dataset.id; // Ambil ID jadwal dari atribut data-id
            if (confirm("Are you sure you want to delete this schedule?")) {
                try {
                    const response = await fetch('DELETE_SCHEDULE.PHP', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `id=${scheduleId}` // Kirim ID sebagai data POST
                    });

                    const result = await response.json();
                    console.log(result);

                    if (result.success) {
                        alert("Schedule successfully deleted!");
                        location.reload(); // Reload halaman untuk memperbarui tabel
                    } else {
                        alert("Failed to delete the schedule: " + (result.error || "Unknown error"));
                    }
                } catch (error) {
                    console.error("Error occurred: ", error);
                    alert("An unexpected error occurred.");
                }
            }
        }
    });

    // Tombol cetak PDF jika diperlukan
    buttonPrint.addEventListener("click", () => {
        window.open("generate_pdf.php", "_blank");
    });
});

    </script>
</body>

</html>
