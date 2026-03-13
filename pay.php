<?php

$merchantId  = "YOUR_MERCHANT_ID";
$saltKey     = "YOUR_SALT_KEY";
$saltIndex   = "YOUR_SALT_INDEX";

$amount = intval($_POST['amount']) * 100; // convert ₹ to paise
$transactionId = "TXN" . time();

// payload
$data = [
    "merchantId" => $merchantId,
    "merchantTransactionId" => $transactionId,
    "merchantUserId" => "Donor_" . rand(100,999),
    "amount" => $amount,
    "redirectUrl" => "https://YOUR_DOMAIN/status.php?txnid=$transactionId",
    "callbackUrl" => "https://YOUR_DOMAIN/status.php?txnid=$transactionId",
    "paymentInstrument" => ["type" => "PAY_PAGE"]
];

$payload = base64_encode(json_encode($data));
$checksum = hash("sha256",$payload."/pg/v1/pay".$saltKey) . "###" . $saltIndex;

// API call
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/pay",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "X-VERIFY: $checksum"
    ],
    CURLOPT_POSTFIELDS => json_encode(["request"=>$payload])
]);

$response = curl_exec($curl);
curl_close($curl);

$res = json_decode($response,true);

// redirect to PhonePe
if ($res["success"] === true) {
    $url = $res["data"]["instrumentResponse"]["redirectInfo"]["url"];
    header("Location: $url");
    exit;
} else {
    echo "<h2>Payment could not be initiated.</h2>";
}
?>
