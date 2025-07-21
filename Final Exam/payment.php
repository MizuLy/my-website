<?php
$prodcode = isset($_GET['prodcode']) ? htmlspecialchars($_GET['prodcode']) : '';
$prodname = isset($_GET['prodname']) ? htmlspecialchars($_GET['prodname']) : '';
$price = isset($_GET['price']) ? floatval($_GET['price']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="img/logo.png" />
  <title>Payment</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;600&display=swap');

  body {
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    font-family: 'Josefin Sans', sans-serif;
    color: #eee;
    margin: 0;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
  }

  .payment-form {
    background: #1e1e1e;
    padding: 40px 30px;
    border-radius: 20px;
    width: 100%;
    max-width: 420px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.6);
    transition: all 0.3s ease;
  }

  .payment-form:hover {
    box-shadow: 0 15px 45px rgba(0,0,0,0.8);
  }

  h2 {
    color: gold;
    text-align: center;
    font-size: 1.8em;
    margin-bottom: 30px;
  }

  label {
    font-size: 0.9em;
    margin-bottom: 6px;
    display: block;
    font-weight: 600;
    color: #ccc;
  }

input, select, textarea {
  display: block;
  width: 100%;
  padding: 12px 14px;
  margin-bottom: 18px;
  border-radius: 8px;
  border: 1px solid rgba(255,255,255,0.2);
  background: rgba(255,255,255,0.06);
  color: #fff;
  font-size: 1rem;
  box-sizing: border-box; /* ensures padding stays inside width */
}

select{
  color: grey;
}

input:focus, select:focus, textarea:focus {
  outline: none;
  border-color: gold;
  background: rgba(255,255,255,0.1);
  box-shadow: 0 0 8px rgba(255,215,0,0.6);
}


  textarea {
    resize: vertical;
    min-height: 80px;
  }

  button {
    background: linear-gradient(90deg, gold, #f8e473);
    color: #1e1e1e;
    font-size: 1.1em;
    font-weight: 600;
    border: none;
    border-radius: 10px;
    padding: 14px;
    width: 100%;
    cursor: pointer;
    transition: background 0.3s ease;
  }

  button:hover {
    background: linear-gradient(90deg, #ffe066, #ffdb4d);
  }

  .back-btn {
    margin-top: 18px;
    display: block;
    text-align: center;
    color: #f1c40f;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9em;
  }

  .back-btn:hover {
    text-decoration: underline;
  }

  #qrCodeContainer {
    display: none;
    margin-top: 15px;
    text-align: center;
  }

  #qrCodeContainer img {
    width: 180px;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(255, 215, 0, 0.8);
  }
</style>

</head>
<body>
  <div class="payment-form">
    <h2>Payment Details</h2>
    <form action="process_order.php" method="POST" id="paymentForm">
      <input type="hidden" name="prodcode" value="<?php echo $prodcode; ?>" />
      <input type="hidden" name="prodname" value="<?php echo $prodname; ?>" />
      <input type="hidden" name="price" value="<?php echo $price; ?>" />

      <label>Car Model</label>
      <input type="text" value="<?php echo $prodname; ?>" disabled />

      <label>Price (USD)</label>
      <input type="text" value="<?php echo number_format($price, 2); ?>" disabled />

      <label>Quantity</label>
      <input type="number" name="qty" min="1" value="1" required />

      <label>Full Name</label>
      <input type="text" name="cusname" required />

      <label>Email</label>
      <input type="email" name="email" required />

      <label>Phone Number</label>
      <input type="tel" name="phone" required />

      <label>Address</label>
      <textarea type="address" name="address" required rows="3"></textarea>

      <label>Payment Method</label>
      <select name="payment_method" id="payment_method" required>
        <option value="">-- Select Payment Method --</option>
        <option value="QR">QR Code</option>
        <option value="Cash">Cash On Delivery</option>
      </select>

      <div id="qrCodeContainer">
        <h3>Scan this QR code to pay:</h3>
        <img src="img/qr.png" alt="QR Code"/>
      </div>

      <button type="submit" name="buy" value="buy">Confirm Purchase</button>
    </form>

    <a href="car.php" class="back-btn">Go Back to Car Selection</a>
  </div>

  <script>
    const paymentSelect = document.getElementById('payment_method');
    const qrCodeContainer = document.getElementById('qrCodeContainer');

    paymentSelect.addEventListener('change', function () {
      if (this.value === 'QR') {
        qrCodeContainer.style.display = 'block';
      } else {
        qrCodeContainer.style.display = 'none';
      }
    });
  </script>
</body>
</html>
