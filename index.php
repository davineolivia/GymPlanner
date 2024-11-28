<?php
// Mulai session
session_start();

// Cek apakah pengguna sudah login
if (isset($_SESSION['user'])) {
    // Jika sudah login, redirect ke dashboard
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymPlanner</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Manjari:wght@100;400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include 'header.php'; ?> <!-- Menyisipkan header -->

    <section class="intro">
        <div class="intro-text">
            <h1>GymPlanner</h1>
            <h2>Shape Your Body to Hourglass or Sixpack, Start Here!</h2>
            <p>
                GymPlanner akan membantu anda untuk merencanakan dan melacak latihan sehingga anda bisa mencapai tubuh
                impian, mulai dari perut sixpack hingga lekuk hourglass.
                <span style="color: #40b8fe;">Apa saja yang akan GymPlanner tawarkan?</span>
            </p>
            <ul>
                <li>Menyiapkan jadwal untuk Gym</li>
                <li>Memberikan pengingat untuk Gym</li>
                <li>Memantau progres Gym anda</li>
                <li>Memberikan latihan sederhana di rumah</li>
            </ul>
            <p>
                Let’s shape your dream body with us—login to your account or create a new account now!
                <a href="login.php" style="color: #a56e56;">bring me to login page now.</a>
            </p>
        </div>
        <div class="intro-image">
            <img src="img/image.png" alt="GymPlanner Image">
        </div>
    </section>

    <section class="membership">
        <h2>Make Your Account to Premium</h2>
        <div class="membership-options">
            <div class="membership-option" id="silver-option">
                <img src="img/member.jpeg" alt="Member Silver" class="membership-img">
                <button class="membership-btn">Member Silver</button>
            </div>
            <div class="membership-option">
                <img src="img/member2.jpeg" alt="Member Gold" class="membership-img">
                <button class="membership-btn">Member Gold</button>
            </div>
            <div class="membership-option">
                <img src="img/member3.jpg" alt="Member Platinum" class="membership-img">
                <button class="membership-btn">Member Platinum</button>
            </div>
        </div>
        <p>These three members have their own uniqueness. Where silver members purchase daily,
            gold members purchase weekly, platinum members purchase monthly. This member will
            open additional features such as a gym list that you must do at the gym, set food
            portions and calories that day, record drinks. Payment for this premium member can
            be made at your gym. So for bodyshapers who gym at home, this member does not apply.</p>
    </section>

    <section class="promo">
        <img src="img/imagee.png" alt="Promotional Image">
        <div class="promo-content">
            <h2>Amazing News for Today</h2>
            <p>jangan sampai menyesal karena ketinggalan diskon</p>
            <h1>Get the 50% Discount</h1>
            <p>*Khusus untuk pembelian member gold dan platinum saja.</p>
            <p>*Member silver, gold dan platinum hanya untuk BodyShapers yang latihan di tempat Gym.</p>
            <p>*Dapatkan diskon di tempat gym kalian yang pastinya sudah berhubungan dengan GymPlanner.</p>
        </div>
    </section>

    <?php include 'footer.php'; ?> <!-- Menyisipkan footer -->

    <!-- PopUp Box -->
    <div id="popup-box" class="popup-box">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <h2>You Have Good News!</h2>
            <p>let's scroll down this website to get something surprising</p>
        </div>
    </div>

    <!-- Toast/Snackbar -->
    <div id="toast" class="toast">Hello BodyShapers, are you miss GymPlanner?</div>

    <script>
        // Penerapan DOM
        // Tambahan Mengubah warna teks pada promo heading
        document.querySelector('.promo h2').style.color = '#a56e56';

        // Tambahan Mengubah teks pada h1
        document.querySelector('h1').textContent = 'Welcome to GymPlanner';

        // Tambahan event klik pada heading promo
        const promoHeading = document.querySelector('.promo h1');
        promoHeading.style.cursor = 'pointer'; // Mengubah kursor menjadi pointer
        promoHeading.addEventListener('click', () => {
            alert('Tidak ada apa-apa di sini, apa yang kamu harapkan?');
        });

        // Fungsi untuk membuka popup
        function openPopup() {
            const popup = document.getElementById('popup-box');
            popup.style.display = 'flex';
        }

        // Fungsi untuk menutup popup dan menampilkan toast
        function closePopup() {
            const popup = document.getElementById('popup-box');
            popup.style.display = 'none';
            // Tampilkan toast setelah popup ditutup
            showToast();
        }

        // Fungsi untuk menampilkan toast
        function showToast() {
            const toast = document.getElementById('toast');
            toast.classList.add('show'); // Menampilkan toast
            setTimeout(() => {
                toast.classList.remove('show'); // Menghilangkan toast setelah 4 detik
            }, 4000);
        }

        // Tampilkan popup saat halaman pertama kali dimuat
        window.onload = function () {
            setTimeout(openPopup, 2000); // Popup muncul setelah 2 detik
        };
    </script>
</body>

</html>
