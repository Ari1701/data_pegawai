<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/pegawai/assets/css/style.css">
</head>
<body>
    <?php
    // Configuration and data
    $pageTitle = "Welcome to Employee Data Management System";
    $introText = "Efficiently manage and track your employee data with ease.";
    ?>

    <header>
        <nav>
            <div>
                <span>ATravel</span>
            </div>
            <div>
                <a href="index.php">Home</a>
                <a href="#about-us">About Us</a>
                <a href="#service">Service</a>
                <a href="#contact">Contact</a>
                <a href="#" id="loginBtn">Login</a>
            </div>
        </nav>
    </header>

    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form class="login-form" action="auth/login_proses.php" method="post">
                <h2>Login</h2>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <section class="bg-section">
        <div class="bg-content">
            <h1>Welcome to ATravel</h1>
            <p>Melayani dan Mengayomi seepenuh hati.</p>
        </div>
    </section>

    <section class="about-section" id="about-us">
    <div class="about-content">
        <h2>About Us</h2>
        <p>Aplikasi travel ini menyediakan pengguna dengan kemudahan dalam merencanakan dan memesan perjalanan, termasuk pencarian destinasi wisata, customisasi rencana perjalanan sesuai preferensi individu, dan integrasi layanan seperti pemesanan tiket transportasi dan akomodasi. Selain itu, aplikasi ini memberikan informasi mendetail tentang destinasi wisata, ulasan pengguna, dan tips lokal untuk membantu pengguna mempersiapkan perjalanan mereka dengan lebih baik, ditunjang oleh antarmuka pengguna yang ramah dan dukungan pelanggan yang responsif untuk pengalaman yang lancar dan memuaskan.</p>
    </div>
</section>

<section class="services-section" id="service">
    <div class="service-box">
        <h3>Open Trip</h3>
        <p>Explore new destinations with our open group trips. Join other travelers for an unforgettable experience.</p>
    </div>
    <div class="service-box">
        <h3>Rental Services</h3>
        <p>Rent a wide range of travel equipment and gear for your next adventure. Quality and convenience guaranteed.</p>
    </div>
    <div class="service-box">
        <h3>Custom Tours</h3>
        <p>Plan your personalized travel itinerary with us. We design trips tailored to your preferences and interests.</p>
    </div>
</section>

<section class="contact-section" id="contact">
    <h2>Contact Us</h2>
    <p>Have questions or need assistance? Feel free to reach out to us!</p>
    <ul>
        <li>Email: info@yourcompany.com</li>
        <li>Phone: +1234567890</li>
        <li>Address: 123 Travel Street, Cityville, Country</li>
    </ul>
</section>



    <footer>
        <p>&copy; <?php echo date("Y"); ?> ATravel. All rights reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="/pegawai/assets/js/landing.js"></script>
</body>
</html>
