
<?php

function generateCertificateHTML($name, $donation_id, $amount, $date)
{
    $html = "
    <div style='
        font-family: Times New Roman, serif;
        text-align:center;
        padding:40px;
        background:#fdfaf5;
    '>
        <div style='border:10px solid #d4b06a; padding:28px; background:#fff;'>
          <div style='border:2px solid #d4b06a; padding:30px 40px;'>

            <h1 style='font-size:34px; letter-spacing:1px; margin-bottom:6px; color:#5a4200;'>
                Certificate of Appreciation
            </h1>

            <p>Presented by <b>Subhvaishali Foundation</b></p>

            <h2 style='font-size:22px; margin:16px 0 6px;'>Presented To</h2>

            <div style='font-size:24px; font-weight:bold; margin:10px 0;'>
                ".htmlspecialchars($name)."
            </div>

            <p>In heartfelt recognition of your generous contribution towards</p>
            <p>the welfare and upliftment of underprivileged and tribal communities.</p>

            <div style='font-size:18px; margin:8px 0;'>
                Donation Amount: <b>".number_format($amount,2)."</b>
            </div>

            <p>Donation ID: <b>#".$donation_id."</b></p>
            <p>Date: <b>".$date."</b></p>

            <div style='margin-top:34px; display:flex; justify-content:space-between; align-items:center; font-size:13px;'>

                <div style='text-align:left; margin-left:20px;'>
                 <br>Mayur Thoke
                    <div style='margin-top:28px; border-top:1px solid #444; width:190px;'></div>
                    <div>Founder</div>
                    <div><b>Subhvaishali Foundation</b></div>
                </div>

            </div>

          </div>
        </div>
    </div>
    ";

    return $html;
}
?>
