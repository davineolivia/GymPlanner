<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymPlanner Dashboard</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Manjari:wght@100;400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/dashboard-styles.css">
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
                    <li class="active">
                        <a href="dashboard.html">
                            <img src="img/home.png" alt="Dashboard Icon"> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="schedule.html">
                            <img src="img/schedule.png" alt="Schedule Icon"> Schedule
                        </a>
                    </li>
                    <li>
                        <a href="checklist.html">
                            <img src="img/checklist.png" alt="Checklist Icon"> Checklist
                        </a>
                    </li>
                    <li>
                        <a href="settings.html">
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
                    <h1>Hi, Viaa!</h1>
                    <p>Let's take a look at your activity today</p>
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
                        <p class="caption">The data above is the result of
                            how many calories you burned for your workout today
                            and also how much time you spent on the workout.
                            So.. JUST KEEP FIGHTING, BODYSHAPERS!!</p>
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
                            <div class="day-name">Sun</div>
                            <div class="day-name">Mon</div>
                            <div class="day-name">Tue</div>
                            <div class="day-name">Wed</div>
                            <div class="day-name">Thu</div>
                            <div class="day-name">Fri</div>
                            <div class="day-name">Sat</div>

                            <!-- Dates of the Calendar -->
                            <div class="day empty"></div>
                            <div class="day empty"></div>
                            <div class="day">1</div>
                            <div class="day">2</div>
                            <div class="day">3</div>
                            <div class="day">4</div>
                            <div class="day">5</div>
                            <div class="day">6</div>
                            <div class="day">7</div>
                            <div class="day">8</div>
                            <div class="day">9</div>
                            <div class="day">10</div>
                            <div class="day">11</div>
                            <div class="day">12</div>
                            <div class="day">13</div>
                            <div class="day">14</div>
                            <div class="day">15</div>
                            <div class="day">16</div>
                            <div class="day">17</div>
                            <div class="day">18</div>
                            <div class="day">19</div>
                            <div class="day">20</div>
                            <div class="day">21</div>
                            <div class="day">22</div>
                            <div class="day">23</div>
                            <div class="day">24</div>
                            <div class="day">25</div>
                            <div class="day">26</div>
                            <div class="day">27</div>
                            <div class="day">28</div>
                            <div class="day completed">29</div>
                            <div class="day scheduled">30</div>
                        </div>

                        <div class="calendar-key">
                            <div><span class="completed"></span> Completed: Training completed on that day</div>
                            <div><span class="scheduled"></span> Scheduled: Training is scheduled for that day</div>
                            <div><span class="empty"></span> Empty: No activity on that day</div>
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
                            <div>Ab Exercises</div>
                            <div>3/5 sessions completed</div>
                        </li>
                    </ul>
                </div>
            </section>
        </main>
    </div>
</body>

</html>