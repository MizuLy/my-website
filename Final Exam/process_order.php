<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$pass = "";
$db = "finals";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Safer saleid generator — checks DB to avoid duplicates
function generateNextSaleId($conn) {
    $prefix = 'N';
    $num = 1;
    while (true) {
        $saleid = $prefix . str_pad($num, 4, '0', STR_PAD_LEFT);
        $check = $conn->query("SELECT saleid FROM tblsale WHERE saleid = '$saleid'");
        if ($check && $check->num_rows == 0) {
            return $saleid;
        }
        $num++;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy'])) {
    $prodcode = $conn->real_escape_string($_POST['prodcode'] ?? '');
    $prodname = $conn->real_escape_string($_POST['prodname'] ?? '');
    $price = floatval($_POST['price'] ?? 0);
    $qty = intval($_POST['qty'] ?? 1);

    $cusname = $conn->real_escape_string($_POST['cusname'] ?? '');
    $email = $conn->real_escape_string($_POST['email'] ?? '');
    $phone = $conn->real_escape_string($_POST['phone'] ?? '');
    $address = $conn->real_escape_string($_POST['address'] ?? '');
    $payment_method = $conn->real_escape_string($_POST['payment_method'] ?? '');

    $total = $price * $qty;
    $order_date = date('Y-m-d H:i:s');

    // Generate unique saleid
    $saleid = generateNextSaleId($conn);

    // Check if customer exists by email
    $cusid = '';
    $sqlCheckCustomer = "SELECT cusid FROM tblcustomer WHERE email = '$email' LIMIT 1";
    $res = $conn->query($sqlCheckCustomer);
    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $cusid = $row['cusid'];
        // Update existing customer info
        $sqlUpdate = "UPDATE tblcustomer SET cusname='$cusname', phone='$phone', address='$address' WHERE cusid='$cusid'";
        $conn->query($sqlUpdate);
    } else {
        // Generate new cusid like C0001, C0002...
        $result = $conn->query("SELECT cusid FROM tblcustomer ORDER BY cusid DESC LIMIT 1");
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lastCusId = $row['cusid']; // e.g. C0001
            $numCus = intval(substr($lastCusId, 1));
            $numCus++;
            $cusid = 'C' . str_pad($numCus, 4, '0', STR_PAD_LEFT);
        } else {
            $cusid = 'C0001';
        }
        // Insert new customer
        $sqlInsertCustomer = "INSERT INTO tblcustomer (cusid, cusname, phone, email, address)
                              VALUES ('$cusid', '$cusname', '$phone', '$email', '$address')";
        $conn->query($sqlInsertCustomer);
    }

    // Insert sale record with prepared statement
    $stmt = $conn->prepare("INSERT INTO tblsale (saleid, cusid, cusname, prodcode, qty, total, payment_method, order_date) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        $msg = "Prepare failed: " . $conn->error;
        $redirect = "payment.php";
        echo "<script>alert(".json_encode($msg)."); window.location.href = ".json_encode($redirect).";</script>";
        exit;
    }
    $stmt->bind_param("ssssisds", $saleid, $cusid, $cusname, $prodcode, $qty, $total, $payment_method, $order_date);

    if ($stmt->execute()) {
        $msg = "Purchased successful! $cusname, you have confirmed $qty $prodname for $" . number_format($total, 2) . ".";
        $redirect = "index.php";
    } else {
        $msg = "Error: " . $stmt->error;
        $redirect = "payment.php";
    }

    $stmt->close();
    $conn->close();

    echo "<script>
        alert(".json_encode($msg).");
        window.location.href = ".json_encode($redirect).";
    </script>";
    exit;
} else {
    echo "<script>
        alert('Invalid access.');
        window.location.href = 'index.php';
    </script>";
    exit;
}
