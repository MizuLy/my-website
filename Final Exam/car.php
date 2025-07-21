<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "finals";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Connection Error! ' . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="img/logo.png" />
  <title>Car shop</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Anton&family=Jaro:opsz@6..72&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Kdam+Thmor+Pro&display=swap");

    :root {
      --primary-bg: #181a1b;
      --secondary-bg: #232526;
      --accent: #b0b3b8;
      --text-main: #f5f6fa;
      --text-secondary: #b0b3b8;
      --highlight: #3a3f44;
      --gold: gold;
    }

    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      font-family: "Josefin Sans";
    }

    html {
      background-color: var(--primary-bg);
      height: 100%;
      color: white;
      scroll-behavior: smooth;
    }

    header {
      background-color: var(--secondary-bg);
      color: var(--text-main);
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 10px;
      padding: 8px;
      border-radius: 20px;
      user-select: none;
      box-shadow: 0 4px 12px rgb(69, 54, 54);
    }

    header ul {
      display: flex;
      gap: 6em;
      list-style: none;
      align-items: center;
    }

    header ul li a {
      text-decoration: none;
      color: var(--text-secondary);
      font-size: 1.2em;
      padding: 10px;
      border-radius: 6px;
      transition: background 0.2s, color 0.2s;
    }

    header ul li a:hover {
      background-color: var(--highlight);
      color: var(--text-main);
    }

    .brand,
    h1 {
      text-align: center;
      padding: 50px;
    }

    .image-row {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      gap: 100px;
    }

    .car-card {
      width: 400px;
      height: 300px;
      border-radius: 16px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
      transition: transform 0.2s ease;
    }

    .car-card img {
      height: 180px;
      width: auto;
      object-fit: contain;
      display: block;
      transition: transform 0.3s ease, box-shadow 0.3s ease, filter 0.3s ease;
    }

    .car-card:hover img {
      transform: scale(1.2);
      filter: drop-shadow(0 4px 24px rgba(255, 255, 255, 0.8));
    }

    .order-box {
      margin-top: 16px;
    }

    /* Changed button to link style */
    .order-box a.buy-btn {
      background: var(--highlight);
      color: var(--text-main);
      border: none;
      border-radius: 8px;
      padding: 12px 32px;
      font-size: 1.1em;
      cursor: pointer;
      transition: background 0.2s, color 0.2s;
      text-decoration: none;
      display: inline-block;
      text-align: center;
    }

    .order-box a.buy-btn:hover {
      background: var(--gold);
      color: #232526;
    }

    footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: var(--secondary-bg);
      color: var(--text-secondary);
      padding: 20px 40px;
      font-size: 1em;
      border-radius: 0 0 16px 16px;
      margin-top: 40px;
    }

    footer a {
      color: var(--gold);
      text-decoration: none;
      margin: 0 8px;
      transition: color 0.2s;
    }

    footer a:hover {
      color: var(--text-main);
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <a href="car.php">
        <img src="img/logo.png" alt="Mizu" width="100px" />
      </a>
    </div>
  </header>

  <!-- Bugatti Section -->
  <section id="bugatti">
    <div class="brand">
      <h1>Bugatti</h1>
      <div class="image-row">
        <div class="car-card">
          <img src="car/blue.png" alt="Bugatti Blue" />
          <div class="order-box">
            <a
              href="payment.php?prodcode=BUG001&prodname=Bugatti%20Blue&price=2000000"
              class="buy-btn"
            >
              Buy Now
            </a>
          </div>
        </div>
        <div class="car-card">
          <img src="car/silverblack.png" alt="Bugatti Silver Black" />
          <div class="order-box">
            <a
              href="payment.php?prodcode=BUG002&prodname=Bugatti%20Silver%20Black&price=2000000"
              class="buy-btn"
            >
              Buy Now
            </a>
          </div>
        </div>
        <div class="car-card">
          <img src="car/orangeblack.png" alt="Bugatti Orange Black" />
          <div class="order-box">
            <a
              href="payment.php?prodcode=BUG003&prodname=Bugatti%20Orange%20Black&price=2000000"
              class="buy-btn"
            >
              Buy Now
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Dodge Section -->
  <section id="dodge">
    <div class="brand">
      <h1>Dodge</h1>
      <div class="image-row">
        <div class="car-card">
          <img src="car/red.png" alt="Dodge Red" />
          <div class="order-box">
            <a
              href="payment.php?prodcode=DOD001&prodname=Dodge%20Red&price=60000"
              class="buy-btn"
            >
              Buy Now
            </a>
          </div>
        </div>
        <div class="car-card">
          <img src="car/black.png" alt="Dodge Black" />
          <div class="order-box">
            <a
              href="payment.php?prodcode=DOD002&prodname=Dodge%20Black&price=60000"
              class="buy-btn"
            >
              Buy Now
            </a>
          </div>
        </div>
        <div class="car-card">
          <img src="car/blackwhite.png" alt="Dodge Black White" />
          <div class="order-box">
            <a
              href="payment.php?prodcode=DOD003&prodname=Dodge%20Black%20White&price=60000"
              class="buy-btn"
            >
              Buy Now
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Lamborghini Section -->
  <section id="lamborghini">
    <div class="brand">
      <h1>Lamborghini</h1>
      <div class="image-row">
        <div class="car-card">
          <img src="car/orange.png" alt="Lamborghini Orange" />
          <div class="order-box">
            <a
              href="payment.php?prodcode=LAM001&prodname=Lamborghini%20Orange&price=400000"
              class="buy-btn"
            >
              Buy Now
            </a>
          </div>
        </div>
        <div class="car-card">
          <img src="car/white.png" alt="Lamborghini White" />
          <div class="order-box">
            <a
              href="payment.php?prodcode=LAM002&prodname=Lamborghini%20White&price=400000"
              class="buy-btn"
            >
              Buy Now
            </a>
          </div>
        </div>
        <div class="car-card">
          <img src="car/neon.png" alt="Lamborghini Neon" />
          <div class="order-box">
            <a
              href="payment.php?prodcode=LAM003&prodname=Lamborghini%20Neon&price=400000"
              class="buy-btn"
            >
              Buy Now
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="left-footer">
      <p>&copy; 2025 Mizu Garage. All rights reserved.</p>
    </div>
    <div class="center-footer">
      <p>
        <a href="mailto:info@mizugarage.com">info@mizugarage.com</a> |
        <a href="tel:+123456789">+1 234 567 89</a>
      </p>
    </div>
    <div class="right-footer">
      <p>
        <a href="#bugatti">Bugatti</a> | <a href="#dodge">Dodge</a> |
        <a href="#lamborghini">Lamborghini</a>
      </p>
    </div>
  </footer>
</body>
</html>
