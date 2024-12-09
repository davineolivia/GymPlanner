<?php
// Konfigurasi koneksi ke database
$host = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'gymplanner';

// Membuat koneksi ke database
$conn = new mysqli($host, $dbUser, $dbPassword, $dbName);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Ambil data hydration dari database
$hydrationQuery = "SELECT * FROM hydration ORDER BY date DESC";
$hydrationResult = $conn->query($hydrationQuery);

// Ambil data workout dari database
$workoutQuery = "SELECT * FROM workout ORDER BY date DESC";
$workoutResult = $conn->query($workoutQuery);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checklist - GymPlanner</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/checklist-styles.css">
</head>

<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <img src="img/logo.png" alt="GymPlanner Best Logo">
            </div>
            <nav>
                <ul>
                    <li><a href="dashboard.php"><img src="img/home.png" alt="Dashboard Icon"> Dashboard</a></li>
                    <li><a href="schedule.php"><img src="img/schedule.png" alt="Schedule Icon"> Schedule</a></li>
                    <li class="active"><a href="checklist.php"><img src="img/checklist.png" alt="Checklist Icon"> Checklist</a></li>
                    <li><a href="settings.php"><img src="img/settings.png" alt="Settings Icon"> Settings</a></li>
                </ul>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <header>
                <h1>Checklist Data</h1>
                <p>How far you drink and workout</p>
                <div class="action-buttons">
                    <button id="buttonback">Back to Checklist</button>
                </div>
            </header>

            <div class="table-container">
                <!-- Hydration Table -->
                <h2>Hydration Data</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Morning (L)</th>
                            <th>Afternoon (L)</th>
                            <th>Evening (L)</th>
                            <th>Total Achieved</th>
                            <th>Date Input</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $hydrationResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['morning']); ?></td>
                            <td><?php echo htmlspecialchars($row['afternoon']); ?></td>
                            <td><?php echo htmlspecialchars($row['evening']); ?></td>
                            <td><?php echo htmlspecialchars($row['total']); ?></td>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                            <td>
                                <button class="edit-btn">Edit</button>
                                <button class="delete-btn">Delete</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Workout Table -->
                <h2>Workout Data</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Body Part</th>
                            <th>Reps</th>
                            <th>Duration (Hours)</th>
                            <th>Calories Burned</th>
                            <th>Date Input</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $workoutResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['body_parts']); ?></td>
                            <td><?php echo htmlspecialchars($row['reps']); ?></td>
                            <td><?php echo htmlspecialchars($row['duration']); ?></td>
                            <td><?php echo htmlspecialchars($row['calories']); ?></td>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                            <td>
                                <button class="edit-btn">Edit</button>
                                <button class="delete-btn">Delete</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script>
        document.getElementById('buttonback').addEventListener('click', function () {
        window.location.href = 'checklist.php';
    });
        </script>
</body>

</html>

<?php
// Tutup koneksi
$conn->close();
?>