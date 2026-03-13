
<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request method.");
}

$name   = trim($_POST['name'] ?? '');
$email  = trim($_POST['email'] ?? '');
$phone  = trim($_POST['phone'] ?? '');
$amount = (int)($_POST['amount'] ?? 0);
$method = trim($_POST['payment_method'] ?? '');
$txnId  = trim($_POST['transaction_id'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $amount <= 0) {
    die("Invalid form data.");
}

// --- HANDLE SCREENSHOT UPLOAD ---
if (!isset($_FILES['screenshot']) || $_FILES['screenshot']['error'] !== UPLOAD_ERR_OK) {
    die("Please upload a payment screenshot.");
}

$uploadDir = __DIR__ . '/uploads';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$tmpName = $_FILES['screenshot']['tmp_name'];
$origName = basename($_FILES['screenshot']['name']);
$ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));

$allowed = ['jpg','jpeg','png','webp'];
if (!in_array($ext, $allowed)) {
    die("Only JPG, JPEG, PNG, WEBP allowed.");
}

$newName = 'donation_' . time() . '_' . rand(1000,9999) . '.' . $ext;
$targetPath = $uploadDir . '/' . $newName;
$relativePath = 'uploads/' . $newName;

if (!move_uploaded_file($tmpName, $targetPath)) {
    die("Failed to save screenshot.");
}

// --- INSERT COMPLETE VALUES ---
$stmt = $conn->prepare("
    INSERT INTO donations_details 
    (name, email, phone, amount, payment_method, transaction_id, message, screenshot, status, created_at)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'PENDING', NOW())
");

$stmt->bind_param(
    "sssissss",
    $name, 
    $email, 
    $phone, 
    $amount, 
    $method, 
    $txnId, 
    $message, 
    $relativePath
);

$stmt->execute();
$donationId = $stmt->insert_id;
$stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
<title>Donation Submitted</title>
<style>
body{
  font-family: Arial, sans-serif;
  background:#eef2ff;
  display:flex;
  justify-content:center;
  align-items:center;
  height:100vh;
}
.box{
  background:white;
  padding:26px;
  border-radius:12px;
  width:360px;
  text-align:center;
  box-shadow:0 10px 30px rgba(0,0,0,0.12);
}
h2{color:#16a34a;margin-bottom:8px;}
p{font-size:14px;color:#444;}
.id-box{
  background:#f1f5f9;
  padding:6px 10px;
  display:inline-block;
  border-radius:6px;
  margin-top:6px;
  font-family:monospace;
}
.btn{
  display:inline-block;
  margin-top:14px;
  background:#4f46e5;
  color:white;
  padding:8px 14px;
  border-radius:6px;
  text-decoration:none;
}
</style>
</head>
<body>

<div class="box">
  <h2>Thank You for Donating! 🎉</h2>
  <p>Your donation details were submitted successfully.</p>
  <p>We will verify your payment and send the receipt + certificate soon.</p>

  <p>Your Donation ID:</p>
  <div class="id-box">#<?php echo $donationId; ?></div>

  <a class="btn" href="index.html">Back to Home</a>
</div>

</body>
</html>
