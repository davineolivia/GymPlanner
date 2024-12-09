<?php
session_start(); // Mulai sesi

// Cek apakah ada pesan toast dari save_hydration.php
$toastMessage = isset($_SESSION['toast']) ? $_SESSION['toast'] : '';
unset($_SESSION['toast']); // Hapus pesan toast agar tidak ditampilkan lagi
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
            <!-- Logo -->
            <div class="logo">
                <img src="img/logo.png" alt="GymPlanner Best Logo">
            </div>

            <nav>
                <ul>
                    <li>
                        <a href="dashboard.php">
                            <img src="img/home.png" alt="Dashboard Icon"> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="schedule.php">
                            <img src="img/schedule.png" alt="Schedule Icon"> Schedule
                        </a>
                    </li>
                    <li class="active">
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
        <main class="main-content">
            <header>
                <h1>Checklist</h1>
                <p>Track your hydration and workouts!</p>
                <div class="button-container">
                    <button id="buttoncheck">Check Data</button>
                    <button id="buttonprint">Print Data</button>
                </div>
            </header>
            <!-- Hydration Section -->
            <div class="checklist-container">
                <section class="checklist hydration">
                    <h2>Have You Had a Drink Today?</h2>
                    <form id="hydration-form" action="save_hydration.php" method="post">
                        <label for="morning-water">Apakah Pagi ini Kamu Sudah Minum? Berapa Liter?</label>
                        <input type="number" id="morning-water" name="morning-water" min="0" step="0.1" placeholder="contoh: 1.5">

                        <label for="afternoon-water">Apakah Siang ini Kamu Sudah Minum? Berapa Liter?</label>
                        <input type="number" id="afternoon-water" name="afternoon-water" min="0" step="0.1" placeholder="contoh: 1.5">

                        <label for="evening-water">Apakah Sore ini Kamu Sudah Minum? Berapa Liter?</label>
                        <input type="number" id="evening-water" name="evening-water" min="0" step="0.1" placeholder="contoh: 2.0">

                        <label for="total-water">Apakah total sudah mencapai 8 liter?</label>
                        <select id="total-water" name="total-water">
                        <option value="yes">Ya</option>
                        <option value="no">Tidak</option>
                        </select>

                        <button type="submit" class="submit-btn">Submit Hydration</button>
                    </form>
                </section>

                <!-- Workout Section -->
                <section class="checklist workout">
                    <h2>Which Body Parts Have You Trained?</h2>
                    <form id="workout-form" action="save_workout.php" method="post">
                        <label for="body-parts">Bagian Tubuh yang Dilatih:</label>
                            <select id="body-parts" name="body-parts">
                                <option value="" disabled selected>Pilih bagian tubuh</option>
                                <option value="arms">Lengan</option>
                                <option value="chest">Dada</option>
                                <option value="back">Punggung</option>
                                <option value="legs">Kaki</option>
                                <option value="core">Perut</option>
                            </select>

                        <label for="reps">Berapa Kali Perulangan:</label>
                        <input type="number" id="reps" name="reps" min="0" placeholder="contoh: 15">

                        <label for="duration">Durasi Workout (jam):</label>
                        <input type="number" id="duration" name="duration" min="0" step="0.1" placeholder="contoh: 1.5">

                        <label for="calories">Kalori yang Dibakar (kcal):</label>
                        <input type="number" id="calories" name="calories" min="0" placeholder="contoh: 500">

                        <button type="submit" class="submit-btn">Submit Workout</button>
                    </form>
                </section>
            </div>
            <!-- Tempat Toast akan muncul -->
<div id="toast" class="toast"><?php echo htmlspecialchars($toastMessage); ?></div>
    </div>
    <script>
        document.getElementById('buttoncheck').addEventListener('click', function () {
        window.location.href = 'checklist-tables.php';
    });
    
    document.addEventListener("DOMContentLoaded", function() {
    const toast = document.getElementById("toast");

    if (toast.textContent.trim() !== "") { // Periksa apakah ada pesan
        toast.classList.add("show");

        // Sembunyikan Toast setelah 3 detik
        setTimeout(function() {
            toast.classList.remove("show");
        }, 3000);
    }
});
</script>

</body>
</html>