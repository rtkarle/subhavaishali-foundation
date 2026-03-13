
<?php

// This returns HTML (not PDF)
// For merging inside final_pdfs
function generateReceiptHTML(
    $donationId,
    $name,
    $email,
    $phone,
    $amount,
    $method,
    $txnId,
    $message,
    $date
) {

    $html = "
    <div style='font-family: Arial, sans-serif; padding: 25px;'>

        <h2 style='text-align:center; margin-bottom: 10px;'>Donation Receipt</h2>

        <p><b>Name:</b> {$name}</p>
        <p><b>Email:</b> {$email}</p>
        <p><b>Phone:</b> {$phone}</p>

        <p><b>Amount Donated:</b> ₹{$amount}</p>
        <p><b>Payment Method:</b> {$method}</p>
        <p><b>Transaction ID:</b> {$txnId}</p>
        <p><b>Date:</b> {$date}</p>

        <p><b>Donation ID:</b> #{$donationId}</p>

        <h3>Donor Message:</h3>
        <p>{$message}</p>

        <p style='margin-top:20px;'>
            This receipt is system generated and valid for donation reference.
        </p>

        <p style='margin-top:30px;'>
            <b>Subhvaishali Foundation</b><br>
            Mumbai, Maharashtra
        </p>

    </div>
    ";

    return $html;
}
