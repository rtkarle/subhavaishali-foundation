<?php
// verify_payment.php
require 'config.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) { echo json_encode(['error'=>'invalid']); exit; }

$payment_id = $input['razorpay_payment_id'] ?? null;
$order_id   = $input['razorpay_order_id'] ?? null;
$signature  = $input['razorpay_signature'] ?? null;

$donor_name  = $input['donor_name'] ?? '';
$donor_email = $input['donor_email'] ?? '';
$donor_phone = $input['donor_phone'] ?? '';
$jar_name    = $input['jar_name'] ?? 'Jar of Kindness';
$amount      = intval($input['amount']); // amount in paise
$sponsor     = !empty($input['sponsor']) ? 1 : 0;

if(!$payment_id || !$order_id || !$signature) {
    echo json_encode(['error'=>'Missing payment data']); exit;
}

// verify signature
$expected_signature = hash_hmac('sha256', $order_id . "|" . $payment_id, RAZOR_KEY_SECRET);
if ($expected_signature !== $signature) {
    echo json_encode(['error'=>'Signature mismatch']); exit;
}

// store donation
$user_id = $_SESSION['user_id'] ?? null;

$stmt = $pdo->prepare("INSERT INTO donations (user_id, donor_name, donor_email, donor_phone, amount, currency, razorpay_order_id, razorpay_payment_id, razorpay_signature, sponsor, jar_name, status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->execute([$user_id, $donor_name, $donor_email, $donor_phone, $amount, 'INR', $order_id, $payment_id, $signature, $sponsor, $jar_name, 'paid']);
$donation_id = $pdo->lastInsertId();

// update user totals if logged in or try to match user by email
if ($user_id) {
    $stmt = $pdo->prepare("UPDATE users SET donation_count = donation_count + 1, total_donated = total_donated + ? WHERE id = ?");
    $stmt->execute([$amount, $user_id]);

    // badge logic
    $stmt = $pdo->prepare("SELECT donation_count, total_donated, name FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $u = $stmt->fetch();

    $awarded = [];
    if ($u['donation_count'] >= 1) {
       // award certificate (every donation gets a certificate per your rule for 1)
       $stmt = $pdo->prepare("INSERT INTO badges_log (user_id, badge) VALUES (?,?)");
       $stmt->execute([$user_id,'certificate']);
       $awarded[] = 'certificate';
    }
    if ($u['donation_count'] >= 15) {
       $stmt = $pdo->prepare("INSERT INTO badges_log (user_id, badge) VALUES (?,?)");
       $stmt->execute([$user_id,'silver']);
       $awarded[] = 'silver';
    }
    if ($u['donation_count'] >= 50) {
       $stmt = $pdo->prepare("INSERT INTO badges_log (user_id, badge) VALUES (?,?)");
       $stmt->execute([$user_id,'gold']);
       $awarded[] = 'gold';
    }
} else {
    // try to find user by email and update counters if found
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$donor_email]);
    $found = $stmt->fetch();
    if ($found) {
        $uid = $found['id'];
        $stmt = $pdo->prepare("UPDATE users SET donation_count = donation_count + 1, total_donated = total_donated + ? WHERE id = ?");
        $stmt->execute([$amount, $uid]);
    }
}

// Return success and donation id to client
echo json_encode(['success'=>true, 'donation_id'=>$donation_id, 'awarded'=>$awarded ?? []]);
exit;
