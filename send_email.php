
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/PHPMailer.php';
require __DIR__ . '/PHPMailer/SMTP.php';
require __DIR__ . '/PHPMailer/Exception.php';

/*
 * Sends final combined PDF (Certificate + Receipt) to donor
 * $pdfPath = final_pdfs/donation_XX.pdf
 */
function sendFinalPDFEmail($toEmail, $toName, $pdfPath, $donation)
{
    $mail = new PHPMailer(true);

    try {
        // SMTP SETTINGS
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // YOUR GMAIL LOGIN (App Password required)
        $mail->Username   = 'subhvaishalifoundation@gmail.com';  // CHANGE IF NEEDED
        $mail->Password   = 'sdskkojstzreezlx';                  // 16-DIGIT APP PASSWORD

        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // SENDER
        $mail->setFrom('subhvaishalifoundation@gmail.com', 'Subhvaishali Foundation');

        // RECEIVER
        $mail->addAddress($toEmail, $toName);

        // ATTACH FINAL PDF
        if (file_exists($pdfPath)) {
            $mail->addAttachment($pdfPath, 'Donation_Certificate_Receipt.pdf');
        }

        // EMAIL CONTENT
        $amount = $donation['amount'];
        $txn    = $donation['transaction_id'] ?? 'N/A';
        $date   = $donation['created_at'];

        $mail->isHTML(true);
        $mail->Subject = 'Your Donation Certificate & Receipt – Subhvaishali Foundation';

        $mail->Body = "
            <h2>Thank You for Your Contribution ❤️</h2>
            <p>Dear <b>{$toName}</b>,</p>

            <p>
            Your generous donation of <b>₹{$amount}</b> has been successfully verified.
            Attached below is your <b>combined PDF</b>, which includes:
            </p>

            <ul>
                <li>✔ Donation Certificate</li>
                <li>✔ Donation Receipt</li>
            </ul>

            <p><b>Transaction ID:</b> {$txn}</p>
            <p><b>Date:</b> {$date}</p>

            <p>
                Your support helps us continue our work for education, healthcare,
                and welfare of underserved communities.
            </p>

            <p>Warm Regards,<br>
            <b>Subhvaishali Foundation</b></p>
        ";

        // ALT BODY
        $mail->AltBody = "Your donation certificate and receipt are attached.";

        $mail->send();
        return true;

    } catch (Exception $e) {
        return "Email Error: " . $mail->ErrorInfo;
    }
}
