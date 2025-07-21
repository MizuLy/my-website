<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="img/logo.png" />
    <title>Mizu Garage</title>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Anton&family=Jaro:opsz@6..72&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Kdam+Thmor+Pro&display=swap");

      :root {
        --primary-bg: #181a1b; /* Dark charcoal background */
        --secondary-bg: #232526; /* Slightly lighter for sections */
        --accent: #b0b3b8; /* Muted silver/gray for accents */
        --text-main: #f5f6fa; /* Almost white for main text */
        --text-secondary: #b0b3b8; /* Muted gray for secondary text */
        --highlight: #3a3f44; /* For hover or highlights */
        --gold: gold; /* Just gold */
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
        justify-content: space-evenly;
        justify-content: center;
        align-items: center;
        margin: 10px;
        padding: 8px;
        border-radius: 20px;
        user-select: none;
        box-shadow: 0 4px 12px rgb(69, 54, 54);
        overflow: hidden;
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

      .display {
        display: flex;
        justify-content: center;
        /* margin-left: 300px; */
      }

      .display img {
        filter: drop-shadow(0 4px 24px #fff);
      }

      .display-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 8rem;
        margin-right: 40px;
        width: 600px;
        height: 400px;
        overflow: hidden;
        border-radius: 50% 0 0 50%;
        box-shadow: 0 4px 24px rgba(228, 228, 228, 0.267);
        text-align: center;
        padding: 30px;
      }

      .display h1 {
        color: var(--text-main);
        font-size: 4em;
      }

      .display p {
        color: var(--text-secondary);
        font-size: 30px;
      }

      marquee {
        color: var(--text-main);
        font-size: 2em;
        font-weight: bold;
        padding: 20px;
        margin: auto;
        user-select: none;
      }

      .sales {
        color: var(--text-main);
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px;
        font-size: 20px;
      }

      .dashboard {
        /* background-color: var(--accent); */
        margin: auto;
        margin-top: 40px;
        padding: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 80px;
        overflow: hidden;
      }

      .dashboard img {
        width: 200px;
        height: 200px;
        object-fit: cover;
        /* border-radius: 14px;
        background-color: var(--highlight); */
        /* filter: drop-shadow(0 4px 12px rgb(255, 255, 255)); */
          transition: transform 0.3s ease, box-shadow 0.3s ease, filter 0.3s ease;
      }

      .dashboard img:hover {
        transform: scale(1.1);
        filter: drop-shadow(0 1px 24px rgba(255,255,255,0.8));
      }

      .contact {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        flex-direction: column;
        gap: 8px;
        margin: 0 auto;
        width: 600px;
        height: 500px;
        background-color: var(--highlight);
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(255, 255, 255, 0.157);
      }

      .contact h2 {
        padding: 20px;
        font-size: 2em;
      }

      .contact input,
      textarea {
        padding: 10px;
        margin: 10px;
        border: none;
        border-radius: 8px;
        outline: none;
        width: 90%;
        font-size: 1em;
      }

      .garage {
        display: flex;
        justify-content: space-evenly;
        align-items: stretch;
        gap: 20px;
        padding: 40px 20px;
        flex-wrap: wrap;
        user-select: none;
      }

      .garage > div {
        background-color: var(--highlight);
        border-radius: 10px;
        padding: 16px;
        width: 300px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        color: var(--text-main);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);       
        transition: transform 0.2s ease, box-shadow 0.3s ease, filter 0.3s ease ;
      }

      .garage img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 16px;
      }

      .garage div:hover{
        transform: scale(1.1);
        filter: drop-shadow(0 1px 10px rgba(255,255,255,0.8));
      }

      .garage h2 {
        margin-bottom: 10px;
      }

      .garage p {
        color: var(--text-secondary);
        margin: 4px 0;
        line-height: 1.4;
      }

      footer {
        display: flex;
        justify-content: space-between;
        padding: 20px 40px;
        background-color: #111;
        color: white;
        flex-wrap: wrap;
        font-size: 1.2em;
        font-weight: bold;
      }

      .left-footer,
      .right-footer {
        display: flex;
        flex-direction: column;
        gap: 10px;
      }

      footer img {
        filter: brightness(0) invert(1);
      }

      .left-footer a,
      .right-footer a {
        color: var(--text-main);
        text-decoration: none;
      }

      .left-footer a:hover,
      .right-footer a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <header>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Services</a></li>
        <div class="logo">
          <img src="img/logo.png" alt="Mizu" width="100px" />
        </div>
        <li><a href="#">About</a></li>
        <li><a href="#">Location</a></li>
      </ul>
    </header>

    <div class="display">
      <div class="display-content">
        <h1>Drive Your <span style="color: var(--gold)">Dream</span></h1>
        <p>
          Drive your dream — into a future where elegance meets engineering and
          every mile reflects your ambition.
        </p>
      </div>
      <img src="img/demon.png" alt="demon" width="1000px" />
    </div>

    <marquee behavior="" direction="" scrollamount="12"
      ><u
        >Cambodia’s Number 1 Car Dealership. Founded in 1995 by Mr. Sea Sengly,
        CEO.</u
      ></marquee
    >

    <div class="sales">
      <h1>Partner <span style="color: var(--gold)">Brand</span></h1>
    </div>
    <div class="dashboard">
      <a href="car.php#bugatti"><img src="img/bugatti.png" alt="bugatti" /></a>
      <a href="car.php#dodge"><img src="img/dodge.png" alt="dodge" /></a>
      <a href="car.php#lamborghini"
        ><img src="img/lamborghini.png" alt="lamborghini"
      /></a>
    </div>
    <br />
    <div class="contact">
      <h2>Leave us your thought</h2>
      <form action="" method="POST">
        <input type="text" placeholder="Name" /><br />
        <input type="email" placeholder="Email" /><br />
        <input type="password" placeholder="Password" /><br />
        <textarea
          name=""
          id=""
          placeholder="Comment your suggestion or question"
          rows="6"
          cols="50"
          style="
            resize: none;
            padding: 10px;
            margin: 10px;
            border: none;
            border-radius: 8px;
            outline: none;
          "
        ></textarea>
      </form>
    </div>
    <br />
    <hr />

    <br />
    <div class="garage">
      <div class="bugatti">
        <img src="garage/bugar.jpg" alt="" width="500px" />
        <h2>Bugatti Garage</h2>
        <p>Located in <span style="color: var(--gold)">Phnom Penh</span></p>
        <p>
          Our premium garage offering Bugatti maintenance, tuning, and private
          showings for high-end collectors.
        </p>
      </div>

      <div class="dodge">
        <img src="garage/dodgar.jpg" alt="" width="500px" />
        <h2>Dodge Garage</h2>
        <p>Located in <span style="color: var(--gold)">Siem Reap</span></p>
        <p>
          Experience raw American muscle with our exclusive Dodge models — test
          drives available daily.
        </p>
      </div>

      <div class="lamborghini">
        <img src="garage/lamgar.webp" alt="" width="500px" />
        <h2>Lamborghini Garage</h2>
        <p>Located in <span style="color: var(--gold)">Sihanoukville</span></p>
        <p>
          Luxury meets performance by the beach. Custom orders and engine tuning
          for supercar lovers.
        </p>
      </div>
    </div><br /><br />

    <footer>
      <div class="left-footer">
        <h2>Contact us <span style="color: gold">through</span></h2>
        <div class="social">
          <img src="asset/Email.png" alt="" style="width: 20px" />
          mizugarage@gmail.com <br /><br />
          <a href="#">Term & Conditions</a>
          |
          <a href="#">Privacy Policy</a>
        </div>
      </div>

      <div class="right-footer">
        <div class="social">
          <a href="https://www.facebook.com/Mizu.469/" target="_blank">
            <img src="asset/Facebook.png" alt="" style="width: 20px" />
            Facebook</a
          >
        </div>
        <div class="social">
          <a
            href="https://www.tiktok.com/@itsbetterthanlove?lang=en"
            target="_blank"
            ><img src="asset/TikTok.png" alt="" style="width: 20px" /> TikTok</a
          >
        </div>
        <div class="social">
          <a
            href="https://www.instagram.com/itsbetterthanlove_/"
            target="_blank"
            ><img src="asset/Instagram.png" alt="" style="width: 20px" />
            Instagram</a
          >
        </div>
      </div>
    </footer>

    <!-- Admin Login Link -->
    <a
      href="#"
      id="adminLoginLink"
      style="
        position: fixed;
        bottom: 10px;
        right: 10px;
        font-size: 12px;
        color: var(--gold);
        text-decoration: underline;
        cursor: pointer;
        user-select: none;
        z-index: 9999;
      "
      >Admin Login</a
    >

    <!-- Admin Login Modal -->
    <div
      id="adminLoginModal"
      style="
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0,0,0,0.8);
        backdrop-filter: blur(3px);
        z-index: 10000;
        justify-content: center;
        align-items: center;
      "
    >
      <div
        style="
          background: var(--secondary-bg);
          padding: 30px;
          border-radius: 10px;
          width: 300px;
          box-shadow: 0 0 15px gold;
          color: white;
          font-family: 'Josefin Sans', sans-serif;
        "
      >
        <h2 style="margin-bottom: 20px; text-align: center;">Admin Login</h2>
        <form id="adminLoginForm" method="POST" action="admin.php" autocomplete="off">
          <label for="username" style="display: block; margin-bottom: 5px;">Username:</label>
          <input
            type="text"
            id="username"
            name="username"
            required
            style="width: 100%; padding: 8px; margin-bottom: 15px; border-radius: 5px; border: none; outline: none;"
          />

          <label for="password" style="display: block; margin-bottom: 5px;">Password:</label>
          <input
            type="password"
            id="password"
            name="password"
            required
            style="width: 100%; padding: 8px; margin-bottom: 20px; border-radius: 5px; border: none; outline: none;"
          />

          <div style="display: flex; justify-content: space-between;">
            <button
              type="submit"
              style="
                background-color: var(--gold);
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                font-weight: bold;
                cursor: pointer;
              "
            >
              Login
            </button>

            <button
              type="button"
              id="cancelLoginBtn"
              style="
                background-color: #555;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                color: white;
                cursor: pointer;
              "
            >
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>

    <script>
      const adminLoginLink = document.getElementById('adminLoginLink');
      const adminLoginModal = document.getElementById('adminLoginModal');
      const cancelLoginBtn = document.getElementById('cancelLoginBtn');

      // Show modal when link clicked
      adminLoginLink.addEventListener('click', e => {
        e.preventDefault();
        adminLoginModal.style.display = 'flex';
      });

      // Hide modal when cancel clicked
      cancelLoginBtn.addEventListener('click', () => {
        adminLoginModal.style.display = 'none';
      });

      // Also close modal if clicked outside the modal content
      adminLoginModal.addEventListener('click', e => {
        if (e.target === adminLoginModal) {
          adminLoginModal.style.display = 'none';
        }
      });
    </script>
  </body>
</html>
