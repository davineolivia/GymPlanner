<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule - GymPlanner</title>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Manjari:wght@100;400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/schedule-styles.css">
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
                    <li class="active"><a href="schedule.php"><img src="img/schedule.png" alt="Schedule Icon"> Schedule</a></li>
                    <li><a href="checklist.php"><img src="img/checklist.png" alt="Checklist Icon"> Checklist</a></li>
                    <li><a href="settings.php"><img src="img/settings.png" alt="Settings Icon"> Settings</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="content">
            <h1>Schedule</h1>
            <button id="buttonadd">+ Add Schedule</button>
            <div class="form-container" id="formContainer" style="display: none;">
                <form id="scheduleForm">
                    <h2>Add New Schedule</h2>
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

            <!-- Schedule Table -->
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
                    <!-- Data akan ditambahkan di sini -->
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const buttonAdd = document.getElementById("buttonadd");
            const formContainer = document.getElementById("formContainer");
            const cancelButton = document.getElementById("cancelButton");
            const scheduleForm = document.getElementById("scheduleForm");
            const scheduleTableBody = document.getElementById("scheduleTableBody");

            // Menampilkan form saat tombol "Add Schedule" diklik
            buttonAdd.addEventListener("click", function() {
                formContainer.style.display = "block";
            });

            // Membatalkan penambahan jadwal
            cancelButton.addEventListener("click", function() {
                formContainer.style.display = "none";
            });

            // Menambahkan jadwal baru ke tabel saat form disubmit
            scheduleForm.addEventListener("submit", function(event) {
                event.preventDefault();

                const activity = document.getElementById("activity").value;
                const focus = document.getElementById("focus").value;
                const location = document.getElementById("location").value;
                const date = document.getElementById("date").value;
                const time = document.getElementById("time").value;

                // Membuat baris baru di tabel jadwal
                const newRow = document.createElement("tr");
                const rowCount = scheduleTableBody.rows.length + 1;
                newRow.innerHTML = `
                    <td>${rowCount}</td>
                    <td>${activity}</td>
                    <td>${focus}</td>
                    <td>${location}</td>
                    <td>${date}</td>
                    <td>${time}</td>
                    <td><button class="delete-btn">Delete</button></td>
                `;

                // Menambahkan baris baru ke tabel
                scheduleTableBody.appendChild(newRow);

                // Menyimpan data ke localStorage
                saveSchedulesToLocalStorage();

                // Menghapus form dan menyembunyikan form
                scheduleForm.reset();
                formContainer.style.display = "none";

                // Menambahkan fungsi hapus untuk baris baru
                const deleteBtn = newRow.querySelector(".delete-btn");
                deleteBtn.addEventListener("click", function() {
                    scheduleTableBody.removeChild(newRow);
                    saveSchedulesToLocalStorage(); // Update localStorage setelah dihapus
                });
            });

            // Menyimpan data jadwal ke localStorage
            function saveSchedulesToLocalStorage() {
                const rows = scheduleTableBody.getElementsByTagName("tr");
                const schedules = [];

                // Ambil data jadwal dari tabel dan simpan ke array
                for (let i = 0; i < rows.length; i++) {
                    const cells = rows[i].getElementsByTagName("td");
                    const schedule = {
                        activity: cells[1].textContent,
                        focus: cells[2].textContent,
                        location: cells[3].textContent,
                        date: cells[4].textContent,
                        time: cells[5].textContent
                    };
                    schedules.push(schedule);
                }

                // Simpan jadwal ke localStorage
                localStorage.setItem("schedules", JSON.stringify(schedules));
            }

            // Memuat data jadwal dari localStorage saat halaman dimuat
            function loadSchedulesFromLocalStorage() {
                const schedules = JSON.parse(localStorage.getItem("schedules")) || [];
                schedules.forEach((schedule, index) => {
                    const newRow = document.createElement("tr");
                    newRow.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${schedule.activity}</td>
                        <td>${schedule.focus}</td>
                        <td>${schedule.location}</td>
                        <td>${schedule.date}</td>
                        <td>${schedule.time}</td>
                        <td><button class="delete-btn">Delete</button></td>
                    `;
                    scheduleTableBody.appendChild(newRow);

                    // Menambahkan fungsi hapus untuk baris yang dimuat dari localStorage
                    const deleteBtn = newRow.querySelector(".delete-btn");
                    deleteBtn.addEventListener("click", function() {
                        scheduleTableBody.removeChild(newRow);
                        saveSchedulesToLocalStorage(); // Update localStorage setelah dihapus
                    });
                });
            }

            // Memuat data jadwal saat halaman dimuat
            loadSchedulesFromLocalStorage();
        });
    </script>
</body>

</html>
