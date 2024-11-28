<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - GymPlanner</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Manjari:wght@100;400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/settings-styles.css">
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
                    <li>
                        <a href="checklist.php">
                            <img src="img/checklist.png" alt="Checklist Icon"> Checklist
                        </a>
                    </li>
                    <li class="active">
                        <a href="settings.php">
                            <img src="img/settings.png" alt="Settings Icon"> Settings
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="content">
            <header>
                <h1>Settings</h1>
            </header>
            <section class="settings-section">
                <h2>End Sessions</h2>
                <p>In this section, you can exit the session if you want to finish or take a break from the workout.</p>

                <div class="logout">
                    <form action="logout.php" method="POST">
                        <button type="submit" class="logout-button">Logout</button>
                    </form>
                </div>
            </section>
        </main>
    </div>
</body>

</html>
