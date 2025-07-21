<?php
session_start();

// Admin credentials - CHANGE before use
define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'password123');

// DB connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "finals";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}

// Handle login submit
if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === ADMIN_USER && $password === ADMIN_PASS) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $login_error = "Invalid username or password.";
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php"); // go back to main page
    exit();
}

// Check login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Admin Login</title>
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                background:#181a1b;
                color:#eee;
                font-family: 'Josefin Sans', sans-serif;
                display:flex;
                justify-content:center;
                align-items:center;
                height:100vh;
            }
            form {
                background:#232526;
                padding:30px;
                border-radius:12px;
            }
            input {
                margin:10px 0;
                padding:8px;
                width:250px;
                border-radius:6px;
                border:none;
                font-family: 'Josefin Sans', sans-serif;
            }
            button {
                width: 100%;
                padding:12px;
                background:gold;
                border:none;
                border-radius:8px;
                font-weight:bold;
                cursor:pointer;
                font-family: 'Josefin Sans', sans-serif;
            }
            .error {
                color:red;
                margin-bottom:10px;
            }
        </style>
    </head>
    <body>
    <form method="POST" action="">
        <h2 style="color:gold; text-align:center;">Admin Login</h2>
        <?php if (!empty($login_error)) echo "<div class='error'>$login_error</div>"; ?>
        <input type="text" name="username" placeholder="Username" required autofocus />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit" name="login">Login</button>
    </form>
    </body>
    </html>
    <?php
    exit();
}

// Handle delete sale
if (isset($_GET['delete_sale_id'])) {
    $saleid = $conn->real_escape_string($_GET['delete_sale_id']);
    $conn->query("DELETE FROM tblsale WHERE saleid='$saleid'");
    header("Location: admin.php");
    exit();
}

// Handle clear all sales
if (isset($_GET['clear_sales'])) {
    $conn->query("TRUNCATE TABLE tblsale");
    header("Location: admin.php");
    exit();
}

// Handle edit sale
if (isset($_POST['edit_sale'])) {
    $saleid = $conn->real_escape_string($_POST['saleid']);
    $qty = (int)$_POST['qty'];
    $total = (float)$_POST['total'];
    $payment_method = $conn->real_escape_string($_POST['payment_method']);
    $cusname = $conn->real_escape_string($_POST['cusname']);
    $status = $conn->real_escape_string($_POST['status']); // new status field

    $conn->query("UPDATE tblsale 
                  SET qty=$qty, total=$total, payment_method='$payment_method', cusname='$cusname', status='$status' 
                  WHERE saleid='$saleid'");
    header("Location: admin.php");
    exit();
}

// Fetch sales
$sales = [];
$result = $conn->query("SELECT * FROM tblsale ORDER BY order_date DESC");
while ($row = $result->fetch_assoc()) {
    $sales[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="icon" href="img/logo.png" />
<title>Admin Dashboard - Sales Report</title>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<style>
  body {
    font-family: 'Josefin Sans', sans-serif;
    background: #181a1b;
    color: #eee;
    margin: 0; padding: 0;
  }
  .container {
    max-width: 1000px;
    margin: 40px auto;
    background: #232526;
    padding: 20px;
    border-radius: 12px;
  }
  h1 {
    color: gold;
    text-align: center;
  }
  form input, form select {
    padding: 8px;
    margin: 6px 0;
    width: 100%;
    border-radius: 6px;
    border: none;
    font-family: 'Josefin Sans', sans-serif;
  }
  form button {
    background: gold;
    border: none;
    padding: 10px 15px;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    font-family: 'Josefin Sans', sans-serif;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    color: #eee;
    font-family: 'Josefin Sans', sans-serif;
  }
  table, th, td {
    border: 1px solid #444;
  }
  th, td {
    padding: 10px;
    text-align: center;
  }
  a.button-link {
    background: #555;
    color: gold;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-family: 'Josefin Sans', sans-serif;
  }
  a.button-link:hover {
    background: gold;
    color: #222;
  }
  .logout {
    text-align: right;
    margin-bottom: 20px;
  }
</style>
</head>
<body>
<div class="container">

  <div class="logout">
    <a href="admin.php?logout=1" class="button-link">Logout</a>
  </div>

  <h1>Sales Report</h1>

  <?php if (count($sales) === 0): ?>
    <p>No sales records found.</p>
  <?php else: ?>

  <table>
    <thead>
      <tr>
        <th>Sale ID</th>
        <th>Customer Name</th>
        <th>Product Code</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Payment Method</th>
        <th>Status</th>
        <th>Order Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($sales as $sale): ?>
        <tr>
          <form method="POST" action="admin.php">
          <td><?=htmlspecialchars($sale['saleid'])?>
            <input type="hidden" name="saleid" value="<?=htmlspecialchars($sale['saleid'])?>" />
          </td>
          <td><input type="text" name="cusname" value="<?=htmlspecialchars($sale['cusname'])?>" style="width:120px; border: none; outline: none; padding: 5px; font-family: 'Josefin Sans';"/></td>
          <td><?=htmlspecialchars($sale['prodcode'])?></td>
          <td><input type="number" name="qty" value="<?=htmlspecialchars($sale['qty'])?>" min="1" style="width:40px; border: none; outline: none; padding: 5px; font-family: 'Josefin Sans';"/></td>
          <td><input type="number" name="total" value="<?=htmlspecialchars($sale['total'])?>" step="0.01" style="width:100px; border: none; outline: none; padding: 5px; font-family: 'Josefin Sans';"/></td>
          <td>
            <select name="payment_method" style="width:100px; padding: 5px; border: none; outline: none; font-family: 'Josefin Sans';">
              <option value="Cash" <?=($sale['payment_method'] === 'Cash' ? 'selected' : '')?>>Cash</option>
              <option value="QR" <?=($sale['payment_method'] === 'QR' ? 'selected' : '')?>>QR</option>
            </select>
          </td>
          <td>
            <select name="status" style="width:100px; padding: 5px; border: none; outline: none; font-family: 'Josefin Sans';">
              <option value="Paid" <?=($sale['status'] === 'Paid' ? 'selected' : '')?>>Paid</option>
              <option value="Unpaid" <?=($sale['status'] === 'Unpaid' ? 'selected' : '')?>>Unpaid</option>
            </select>
          </td>
          <td><?=htmlspecialchars($sale['order_date'])?></td>
          <td>
            <button type="submit" name="edit_sale" style="margin-bottom: 10px;
            background: #555;
            color: lightgreen;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-family: 'Josefin Sans', sans-serif;">Save</button><br/>
            <a href="admin.php?delete_sale_id=<?=urlencode($sale['saleid'])?>" onclick="return confirm('Delete this sale?')" class="button-link" style="
            background: #555;
            color: red;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-family: 'Josefin Sans', sans-serif;">Delete</a>
          </td>
          </form>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif; ?>

  <p style="margin-top:20px; text-align:center;">
    <a href="admin.php?clear_sales=1" onclick="return confirm('Clear ALL sales? This action cannot be undone!')" class="button-link" style="
          background: #555;
          color: red;
          padding: 6px 12px;
          border-radius: 6px;
          text-decoration: none;
          font-family: 'Josefin Sans', sans-serif;">
      Clear All Sales
    </a>
  </p>

</div>
</body>
</html>
