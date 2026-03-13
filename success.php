
<?php
require 'config.php';

// Validate URL parameters
$order_id    = $_GET['order_id'] ?? '';
$payment_id  = $_GET['payment_id'] ?? '';
$signature   = $_GET['signature'] ?? '';

if(!$order_id || !$payment_id || !$signature){
    die("Invalid payment details.");
}

// Verify Razorpay Signature
$body = $order_id . '|' . $payment_id;
$expected_signature = hash_hmac('sha256', $body, RAZORPAY_KEY_SECRET);

if($expected_signature !== $signature){
    // Payment Failed
    $stmt = $conn->prepare("UPDATE donations SET status='FAILED', razorpay_payment_id=?, razorpay_signature=? WHERE razorpay_order_id=?");
    $stmt->bind_param("sss", $payment_id, $signature, $order_id);
    $stmt->execute();
    $stmt->close();

    die("Payment verification failed.");
}

// Payment Success
$stmt = $conn->prepare("UPDATE donations SET status='SUCCESS', razorpay_payment_id=?, razorpay_signature=? WHERE razorpay_order_id=?");
$stmt->bind_param("sss", $payment_id, $signature, $order_id);
$stmt->execute();
$stmt->close();

// Get Donor Info
$res = $conn->query("SELECT * FROM donations WHERE razorpay_order_id='$order_id' LIMIT 1");
$donor = $res->fetch_assoc();

$name   = $donor['name'];
$email  = $donor['email'];
$amount = $donor['amount'];
$id     = $donor['id'];

// Include Certificate File (IMPORTANT)
require_once 'certificate.php';   // <<< FIXED

// Generate Certificate
$cert_path = generateCertificate($name, $id, $amount);

// Send Email with Certificate
require_once 'send_email.php';
sendCertificateEmail($email, $name, $cert_path);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Donation Successful — Subhvaishali</title>
<style>
body{text-align:center;font-family:Inter,sans-serif;background:#f8fff6;color:#222;padding-top:80px}
.box{max-width:500px;margin:auto;background:#fff;border-radius:14px;padding:24px;box-shadow:0 10px 20px rgba(0,0,0,0.12)}
h1{color:#2c9c3d}
a{display:inline-block;margin-top:16px;text-decoration:none;padding:10px 16px;border-radius:8px;background:#ff6a00;color:#fff}
</style>
</head>
<body>

<div class="box">
  <h1>Thank You, <?php echo htmlspecialchars($name); ?>!</h1>
  <p>Your donation of <b>₹<?php echo $amount; ?></b> has been received.</p>
  <p>A certificate of appreciation has been generated and sent to your email.</p>
  <a href="index.html">Go back to Home</a>
</div>

</body>
</html>
