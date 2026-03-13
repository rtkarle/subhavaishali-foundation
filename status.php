<?php

$merchantId  = "YOUR_MERCHANT_ID";
$saltKey     = "YOUR_SALT_KEY";
$saltIndex   = "YOUR_SALT_INDEX";

$txnid = $_GET["txnid"];

$url = "https://api.phonepe.com/apis/hermes/pg/v1/status/$merchantId/$txnid";
$checksum = hash("sha256","/pg/v1/status/$merchantId/$txnid".$saltKey)."###".$saltIndex;

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ["X-VERIFY: $checksum"]
]);
$response = curl_exec($curl);
curl_close($curl);

$res = json_decode($response,true);
$success = ($res["code"] === "PAYMENT_SUCCESS");

?>

<!DOCTYPE html>
<html>
<head>
<title>Donation Status</title>
<style>
body{
  margin:0;font-family:Poppins,sans-serif;
  background:linear-gradient(135deg,#ffe1c7,#fff5ea);
  display:flex;justify-content:center;align-items:center;
  height:100vh;padding:20px;
}
.card{
  background:white;padding:30px;border-radius:20px;
  box-shadow:0 12px 40px rgba(0,0,0,0.18);
  text-align:center;max-width:420px;
  animation:pop .6s ease-out;
}
@keyframes pop{
 from{transform:scale(.85);opacity:0;}
 to{transform:scale(1);opacity:1;}
}
.icon{
  font-size:60px;margin-bottom:12px;
  animation:zoom .6s ease-out;
}
@keyframes zoom{
 from{transform:scale(0);}
 to{transform:scale(1);}
}
h2{margin:0;font-size:26px;}
p{opacity:.75;font-size:14px;margin-top:8px;}
</style>
</head>
<body>

<div class="card">

<?php if($success){ ?>
  <div class="icon">✅</div>
  <h2>Payment Successful</h2>
  <p>Transaction ID: <b><?= $txnid ?></b></p>
  <p>Thank you for supporting Subhvaishali Foundation ❤️</p>
<?php } else { ?>
  <div class="icon">❌</div>
  <h2>Payment Failed</h2>
  <p>We couldn’t verify your payment.</p>
  <p>Please try again.</p>
<?php } ?>

</div>

</body>
</html>
