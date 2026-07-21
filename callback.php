<?php

require 'config.php';
is_login();

if (!isset($_GET['Authority']) || !isset($_GET['Status'])) {
    die("درخواست نامعتبر است.");
}

$authority = $_GET['Authority'];
$status = $_GET['Status'];

if ($status != 'OK') {
    die("پرداخت توسط کاربر لغو شد.");
}

$stmt = $pdo->prepare("SELECT * FROM payments WHERE authority=? LIMIT 1");
$stmt->execute([$authority]);
$payment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$payment) {
    die("تراکنش پیدا نشد.");
}

if ($payment['status'] == 'success') {
    header("Location: oilyform.php");
    exit;
}

$data = [
    "merchant_id" => $merchant_id,
    "amount"      => $payment['amount'],
    "authority"   => $authority
];

$jsonData = json_encode($data);

$ch = curl_init("https://payment.zarinpal.com/pg/v4/payment/verify.json");

curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v4');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
]);

$result = curl_exec($ch);

curl_close($ch);

$result = json_decode($result, true);

if (isset($result['data']) && ($result['data']['code'] == 100 || $result['data']['code'] == 101)) {

    $ref_id = $result['data']['ref_id'];

    $stmt = $pdo->prepare("
        UPDATE payments
        SET status='success',
            ref_id=?,
            paid_at=NOW()
        WHERE authority=?
    ");

    $stmt->execute([$ref_id, $authority]);

    $stmt = $pdo->prepare("
        UPDATE users
        SET is_paid=1
        WHERE id=?
    ");

    $stmt->execute([$payment['user_id']]);

    header("Location: Oilyform.php");
    exit;

} else {

    $stmt = $pdo->prepare("
        UPDATE payments
        SET status='failed'
        WHERE authority=?
    ");

    $stmt->execute([$authority]);

    echo "<h2>پرداخت ناموفق بود.</h2>";

    echo "<pre>";
    print_r($result);
    echo "</pre>";
}