<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gymplanner";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => "Koneksi gagal: " . $conn->connect_error]));
}

// Menangani form submission untuk menambah jadwal
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['activity'])) {
    $activity = $conn->real_escape_string($_POST['activity']);
    $focus = $conn->real_escape_string($_POST['focus']);
    $location = $conn->real_escape_string($_POST['location']);
    $date = $conn->real_escape_string($_POST['date']);
    $time = $conn->real_escape_string($_POST['time']);

    $stmt = $conn->prepare("INSERT INTO schedules (activity, focus, location, date, time) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $activity, $focus, $location, $date, $time);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'scheduleId' => $stmt->insert_id]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
    $stmt->close();
    exit;
}

// Ambil semua jadwal dari database
$sql = "SELECT * FROM schedules";
$result = $conn->query($sql);
$schedules = $result->fetch_all(MYSQLI_ASSOC);

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
            <button id="buttonadd">+ Add Schedule</button>
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
                    <?php if ($schedules): ?>
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
                        <tr><td colspan="7">No schedules available</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const buttonAdd = document.getElementById("buttonadd");
            const formContainer = document.getElementById("formContainer");
            const scheduleForm = document.getElementById("scheduleForm");
            const scheduleTableBody = document.getElementById("scheduleTableBody");

            buttonAdd.addEventListener("click", () => formContainer.style.display = "block");
            document.getElementById("cancelButton").addEventListener("click", () => formContainer.style.display = "none");

            scheduleForm.addEventListener("submit", async function (event) {
                event.preventDefault();
                const formData = new FormData(scheduleForm);
                const response = await fetch('schedule.php', { method: 'POST', body: formData });
                const data = await response.json();

                if (data.success) {
                    alert("Schedule added!");
                    location.reload(); // Refresh untuk melihat perubahan
                } else {
                    alert("Error: " + data.error);
                }
            });

            scheduleTableBody.addEventListener("click", async function (event) {
                if (event.target.classList.contains("delete-btn")) {
                    const scheduleId = event.target.getAttribute("data-id");
                    const response = await fetch('delete_schedule.php', {
                        method: 'POST',
                        body: new URLSearchParams({ id: scheduleId })
                    });
                    const data = await response.json();
                    if (data.success) {
                        alert("Schedule deleted!");
                        location.reload();
                    } else {
                        alert("Error: " + data.error);
                    }
                }
            });
        });
    </script>
</body>

</html>
