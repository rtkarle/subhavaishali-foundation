<?php

function generateCertificate($name, $donation_id, $amount){

    $date = date("F d, Y");

    $html = "
    <html>
    <body style='font-family: Georgia; padding:40px; text-align:center; background:#faf7ef;'>

    <div style='border: 8px solid #d4b06a; padding:40px;'>
    
        <h1 style='font-size:38px; color:#5a4200; margin-bottom:0;'>Certificate of Donation</h1>
        <p style='font-size:16px; margin-top:4px;'>On behalf of <b>Subhvaishali Foundation</b></p>

       

        <p style='font-size:20px; margin-top:10px;'>This certificate is awarded to</p>

        <h2 style='font-size:32px; margin:10px 0; color:#3f2b00;'>$name</h2>

        <p style='font-size:18px; max-width:600px; margin:10px auto;'>
        In recognition of your generous donation of <b>₹$amount</b>  
        in support of our mission to uplift tribal & underserved communities.
        </p>

        <p style='margin-top:25px;'>Donation ID: <b>$donation_id</b></p>
        <p>Date: <b>$date</b></p>

    </div>

    </body>
    </html>
    ";

    if(!is_dir("certificates")){
        mkdir("certificates");
    }

    $file = "certificates/certificate_".$donation_id.".html";
    file_put_contents($file, $html);

    return $file;
}
