<?php

require 'config.php';
is_login();

$user_id = $_SESSION['user_id'];

$amount = 20000; // مبلغ به ریال
$description = 'هزینه آزمون پوست';

// درخواست به زرین‌پال
$data = [
    'merchant_id'  => $merchant_id,
    'amount'       => $amount,
    'callback_url' => $callback_url,
    'description'  => $description,
];

$jsonData = json_encode($data);

$ch = curl_init(
    'https://payment.zarinpal.com/pg/v4/payment/request.json'
);

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


// اگر درخواست پرداخت موفق بود
if (
    isset($result['data']) &&
    isset($result['data']['code']) &&
    $result['data']['code'] == 100
) {

    $authority = $result['data']['authority'];

    // ثبت تراکنش جدید در دیتابیس
    $stmt = $pdo->prepare("
        INSERT INTO payments (
            user_id,
            authority,
            amount,
            status
        )
        VALUES (?, ?, ?, 'pending')
    ");

    $stmt->execute([
        $user_id,
        $authority,
        $amount
    ]);


    // انتقال کاربر به درگاه زرین‌پال
    header(
        'Location: https://payment.zarinpal.com/pg/StartPay/' . $authority
    );

    exit;

} else {

    echo '<h2>خطا در اتصال به زرین‌پال</h2>';

    echo '<pre>';
    print_r($result);
    echo '</pre>';
}