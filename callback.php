<?php

require 'config.php';


// ======================================================
// تابع نمایش پیام
// ======================================================

function showMessage($title, $message, $type = 'danger', $buttonText = 'بازگشت')
{
    global $button;

    $button = '';

    if ($buttonText) {
        $button = '
            <a href="dashboard.php" class="btn btn-primary">
                ' . htmlspecialchars($buttonText) . '
            </a>
        ';
    }

    // نمایش صفحه پیام
    include 'callback-view.php';
    exit;
}


// ======================================================
// بررسی اطلاعات برگشتی از زرین پال
// ======================================================

if (!isset($_GET['Authority']) || !isset($_GET['Status'])) {

    showMessage(
        'درخواست نامعتبر',
        'اطلاعات تراکنش ارسال نشده است.'
    );
}


$authority = $_GET['Authority'];
$status = $_GET['Status'];


// ======================================================
// بررسی لغو شدن پرداخت
// ======================================================

if ($status !== 'OK') {

    showMessage(
        'پرداخت لغو شد',
        'پرداخت توسط کاربر لغو شده است.',
        'danger',
        'بازگشت'
    );
}


// ======================================================
// پیدا کردن تراکنش در دیتابیس
// ======================================================

$stmt = $pdo->prepare("
    SELECT *
    FROM payments
    WHERE authority = ?
    LIMIT 1
");

$stmt->execute([$authority]);

$payment = $stmt->fetch(PDO::FETCH_ASSOC);


// اگر تراکنش پیدا نشد
if (!$payment) {

    showMessage(
        'تراکنش پیدا نشد',
        'اطلاعات این تراکنش در سیستم وجود ندارد.'
    );
}


// ======================================================
// جلوگیری از ثبت دوباره یک پرداخت
// ======================================================

if ($payment['status'] === 'success') {

    header('Location: Oilyform.php');
    exit;
}


// ======================================================
// ارسال درخواست Verify به زرین پال
// ======================================================

$data = [
    'merchant_id' => $merchant_id,
    'amount'      => $payment['amount'],
    'authority'   => $authority
];

$jsonData = json_encode($data);


$ch = curl_init(
    'https://payment.zarinpal.com/pg/v4/payment/verify.json'
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


// ======================================================
// بررسی نتیجه Verify
// ======================================================

if (
    isset($result['data']) &&
    isset($result['data']['code']) &&
    (
        $result['data']['code'] == 100 ||
        $result['data']['code'] == 101
    )
) {

    $ref_id = $result['data']['ref_id'];


    try {

        // شروع تراکنش دیتابیس
        $pdo->beginTransaction();


        // ==================================================
        // قفل کردن رکورد پرداخت
        // ==================================================

        $stmt = $pdo->prepare("
            SELECT *
            FROM payments
            WHERE authority = ?
            LIMIT 1
            FOR UPDATE
        ");

        $stmt->execute([$authority]);

        $payment = $stmt->fetch(PDO::FETCH_ASSOC);


        // اگر قبلاً ثبت شده باشد
        if ($payment['status'] === 'success') {

            $pdo->commit();

            header('Location: Oilyform.php');
            exit;
        }


        // ==================================================
        // ثبت پرداخت موفق
        // ==================================================

        $stmt = $pdo->prepare("
            UPDATE payments
            SET
                status = 'success',
                ref_id = ?,
                paid_at = NOW()
            WHERE authority = ?
        ");

        $stmt->execute([
            $ref_id,
            $authority
        ]);


        // ==================================================
        // افزایش تعداد پرداخت‌های کاربر
        // ==================================================

        $stmt = $pdo->prepare("
            UPDATE users
            SET is_paid = is_paid + 1
            WHERE id = ?
        ");

        $stmt->execute([
            $payment['user_id']
        ]);


        // نهایی کردن تراکنش
        $pdo->commit();


        // ==================================================
        // انتقال کاربر به اولین پرسشنامه
        // ==================================================

        header('Location: Oilyform.php');
        exit;
		


    } catch (Exception $e) {

        // اگر خطایی رخ داد
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }


        showMessage(
            'خطا در ثبت پرداخت',
            'پرداخت تأیید شد اما ثبت اطلاعات آن در سیستم با مشکل مواجه شد.',
            'danger',
            'بازگشت'
        );
    }


} else {


    // ==================================================
    // پرداخت توسط زرین پال تأیید نشده است
    // ==================================================

    $errorMessage = 'پرداخت تأیید نشد.';


    if (
        isset($result['errors']) &&
        isset($result['errors']['message'])
    ) {

        $errorMessage = $result['errors']['message'];
    }


    // ثبت تراکنش ناموفق
    $stmt = $pdo->prepare("
        UPDATE payments
        SET status = 'failed'
        WHERE authority = ?
    ");

    $stmt->execute([$authority]);


    function showMessage($title, $message, $type = 'danger', $buttonText = 'بازگشت')
{
    $button = '';

    if ($buttonText) {
        $button = '
            <a href="dashboard.php" class="btn btn-primary">
                ' . htmlspecialchars($buttonText) . '
            </a>
        ';
    }

    include 'callback-view.php';
    exit;
}
}

?>