
<?php
require 'config.php';
require 'generate_certificate.php';     // must return CERTIFICATE HTML
require 'generate_receipt.php';         // must return RECEIPT HTML
require 'generate_final_pdf.php';       // merges both HTML into 1 PDF
require 'send_email.php';               // FINAL email sender

$id = (int)($_GET['id'] ?? 0);
if (!$id) {
    die("Invalid Donation ID.");
}

// Fetch Donation Record
$res = $conn->query("SELECT * FROM donations_details WHERE id = $id LIMIT 1");
if (!$res || $res->num_rows == 0) {
    die("Donation not found.");
}
$don = $res->fetch_assoc();

// Update status
$conn->query("UPDATE donations_details SET status='APPROVED' WHERE id = $id");

// 1) Generate Certificate HTML
$certificateHTML = generateCertificateHTML(
    $don['name'],
    $id,
    $don['amount'],
    $don['created_at']
);

// 2) Generate Receipt HTML
$receiptHTML = generateReceiptHTML(
    $id,
    $don['name'],
    $don['email'],
    $don['phone'],
    $don['amount'],
    $don['payment_method'],
    $don['transaction_id'],
    $don['message'],
    $don['created_at']
);

// 3) Combine both into 1 PDF
$finalPDF = generateFinalDonationPDF(
    $certificateHTML,
    $receiptHTML,
    $id
);

// 4) send email with FINAL PDF attached
$result = sendFinalPDFEmail(
    $don['email'],
    $don['name'],
    $finalPDF,
    $don
);

// Output
if ($result === true) {
    echo "Donation approved & Final PDF sent to " . htmlspecialchars($don['email']);
} else {
    echo "Donation approved but email failed: " . htmlspecialchars($result);
}
?>
