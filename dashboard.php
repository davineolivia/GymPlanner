<?php
session_start();

// Cek apakah user sudah login, jika belum redirect ke index.php
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

// Variabel user
$user = htmlspecialchars($_SESSION['user']);

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gymplanner";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil jadwal untuk bulan ini
$currentMonth = date('m');
$currentYear = date('Y');
$query = $conn->prepare(
    "SELECT DAY(date) as day, date FROM schedules 
     WHERE MONTH(date) = ? AND YEAR(date) = ?"
);
$query->bind_param("ii", $currentMonth, $currentYear);
$query->execute();
$result = $query->get_result();

$schedules = [];
$today = date('Y-m-d');

while ($row = $result->fetch_assoc()) {
    $status = ($row['date'] < $today) ? 'completed' : (($row['date'] === $today) ? 'scheduled' : '');
    $schedules[$row['day']] = $status;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymPlanner - Dashboard</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Manjari:wght@100;400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/dashboard-styles.css">
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

        <!-- Main Content -->
        <main class="content">
            <!-- Header -->
            <header>
                <div class="welcome">
                    <h1>Hi, <?= $user ?>!</h1>
                    <p>Welcome back! Let's take a look at your activity today.</p>
                </div>
                <div class="header-actions">
                    <input type="text" placeholder="Search for health data">
                    <button class="upgrade-button">Upgrade</button>
                </div>
            </header>

            <!-- Overview Section -->
            <section class="overview">
                <div class="flex-container">
                    <!-- Workout Results -->
                    <div class="workout">
                        <h2>Your Workout Results for Today</h2>
                        <div class="results">
                            <div class="data small-circle">
                                <span class="value">2.30</span>
                                <span class="label">hours</span>
                            </div>
                            <div class="data medium-circle">
                                <span class="value">850</span>
                                <span class="label">kcal burned</span>
                            </div>
                            <div class="data large-circle">
                                <span class="value">1875</span>
                                <span class="label">kcal intake</span>
                            </div>
                        </div>
                        <p class="caption">The data above shows your workout activity today.
                            Keep pushing forward, BodyShapers!</p>
                    </div>

                    <!-- Training Days -->
                    <div class="training-days">
                        <div class="calendar-header">
                            <h2>Your Training Days</h2>
                            <select class="month-selector">
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>

                        <div class="calendar">
                            <!-- Header of the Calendar -->
                            <?php
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
    $firstDayOfWeek = date('w', strtotime("$currentYear-$currentMonth-01"));

    // Tampilkan nama hari
    $days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    foreach ($days as $dayName) {
        echo "<div class='day-name'>$dayName</div>";
    }

    // Tambahkan sel kosong sebelum tanggal pertama
    for ($i = 0; $i < $firstDayOfWeek; $i++) {
        echo "<div class='day empty'></div>";
    }

    // Tampilkan tanggal
    for ($day = 1; $day <= $daysInMonth; $day++) {
        $class = isset($schedules[$day]) ? $schedules[$day] : '';
        echo "<div class='day $class'>$day</div>";
    }
    ?>
                        </div>

                        <div class="calendar-key">
                            <div><span class="completed"></span> Completed: Training completed on that day</div>
                            <div><span class="scheduled"></span> Scheduled: Training is scheduled for that day</div>
                            <div><span class="empty"></span> Empty: No activity on that day</div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="details">
                <div class="vertical-stack">
                    <!-- Steps for Today -->
                    <div class="steps">
                        <h2>Steps for Today</h2>
                        <p>Goal: 8,500 steps</p>
                        <div class="progress">
                            <progress value="5201" max="8500"></progress>
                            <span>5,201 steps</span>
                        </div>
                    </div>

                    <!-- Weight Loss Plan -->
                    <div class="weight-loss">
                        <h2>Weight Loss Plan</h2>
                        <p>68% Completed</p>
                        <div class="progress">
                            <progress value="68" max="100"></progress>
                        </div>
                    </div>
                </div>

                <!-- My Habits Section -->
                <div class="habits">
                    <h2>My Habits</h2>
                    <ul>
                        <li>
                            <div>Stretching</div>
                            <div>9/12 sessions completed</div>
                        </li>
                        <li>
                            <div>Yoga Training</div>
                            <div>6/10 sessions completed</div>
                        </li>
                        <li>
                            <div>Massage</div>
                            <div>4/8 sessions completed</div>
                        </li>
                        <li>
                            <div>Abs Exercises</div>
                            <div>3/5 sessions completed</div>
                        </li>
                    </ul>
                </div>
            </section>
        </main>
    </div>
</body>

</html>