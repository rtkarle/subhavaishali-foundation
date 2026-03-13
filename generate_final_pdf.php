
<?php
require __DIR__ . '/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

function generateFinalDonationPDF($certificateHTML, $receiptHTML, $donationId)
{
    $fullHTML = "
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
            body { font-family: DejaVu Sans, sans-serif; }
            .page-break { page-break-after: always; }
        </style>
    </head>
    <body>

        <div class='certificate'>
            {$certificateHTML}
        </div>

        <div class='page-break'></div>

        <div class='receipt'>
            {$receiptHTML}
        </div>

    </body>
    </html>
    ";

    // Folder create if missing
    if (!is_dir("final_pdfs")) {
        mkdir("final_pdfs", 0777, true);
    }

    $filepath = "final_pdfs/donation_{$donationId}.pdf";

    // DOMPDF Options (All required)
    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);   // ⭐ required for file:// paths

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($fullHTML);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    file_put_contents($filepath, $dompdf->output());

    return $filepath;
}
