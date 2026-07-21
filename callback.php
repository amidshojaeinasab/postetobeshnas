<?php

require 'config.php';
is_login();

function showMessage($title, $message, $type = "danger", $button = null)
{
?>
<!doctype html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title ?></title>

    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
<link rel="stylesheet" href="assets/style.css">


</head>

<body class="body-callback">

<div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card-callback p-5 text-center">

                <?php if($type=="success"){ ?>

                    <div class="icon-callback text-success mb-3">
                        ✔
                    </div>

                <?php }else{ ?>

                    <div class="icon-callback text-danger mb-3">
                        ✖
                    </div>

                <?php } ?>

                <h2 class="mb-3"><?= $title ?></h2>

                <p class="text-muted mb-4"><?= $message ?></p>

                <?php
                if($button){
                    echo $button;
                }
                ?>

            </div>

        </div>

    </div>

</div>

</body>
</html>
<?php
exit;
}



if (!isset($_GET['Authority']) || !isset($_GET['Status'])) {
    showMessage(
        "درخواست نامعتبر",
        "اطلاعات تراکنش ارسال نشده است."
    );
}


$authority = $_GET['Authority'];
$status = $_GET['Status'];

if ($status != 'OK') {
    showMessage(
        "پرداخت لغو شد",
        "پرداخت توسط کاربر لغو شده است.",
        "danger",
        '<a href="payment.php" class="btn btn-primary">بازگشت</a>'
    );
}



$stmt = $pdo->prepare("SELECT * FROM payments WHERE authority=? LIMIT 1");
$stmt->execute([$authority]);

$payment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$payment) {
    showMessage(
        "تراکنش پیدا نشد",
        "اطلاعات این تراکنش در سیستم وجود ندارد."
    );
}


if ($payment['status'] == 'success') {
    header("Location: Oilyform.php");
    exit;
}



$data = [
    "merchant_id"=>$merchant_id,
    "amount"=>$payment['amount'],
    "authority"=>$authority
];

$jsonData=json_encode($data);


$ch=curl_init("https://payment.zarinpal.com/pg/v4/payment/verify.json");

curl_setopt($ch,CURLOPT_USERAGENT,'ZarinPal Rest Api v4');
curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'POST');
curl_setopt($ch,CURLOPT_POSTFIELDS,$jsonData);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_HTTPHEADER,[
    'Content-Type: application/json',
    'Content-Length: '.strlen($jsonData)
]);

$result=curl_exec($ch);

curl_close($ch);

$result=json_decode($result,true);



if(isset($result['data']) && ($result['data']['code']==100 || $result['data']['code']==101)){

    $ref_id=$result['data']['ref_id'];

    $stmt=$pdo->prepare("
        UPDATE payments
        SET
        status='success',
        ref_id=?,
        paid_at=NOW()
        WHERE authority=?
    ");

    $stmt->execute([$ref_id,$authority]);



    $stmt=$pdo->prepare("
        UPDATE users
        SET is_paid=1
        WHERE id=?
    ");

    $stmt->execute([$payment['user_id']]);

?>
<!doctype html>
<html lang="fa" dir="rtl">

<head>

<meta charset="UTF-8">

<meta http-equiv="refresh" content="3;url=Oilyform.php">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
<link rel="stylesheet" href="assets/style.css">

</head>

<body class="body-callback">

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-6">

<div class="card-callback p-5 text-center">

<div class="display-1 text-success mb-3">
✔
</div>

<h2 class="text-success mb-3">
پرداخت با موفقیت انجام شد
</h2>

<p class="text-muted">
کد رهگیری پرداخت
</p>

<h3 class="fw-bold mb-4">
<?= $ref_id ?>
</h3>

<div class="spinner-border text-success mb-3"></div>

<p class="text-muted">
تا چند ثانیه دیگر به صفحه پرسشنامه منتقل می‌شوید...
</p>

</div>

</div>

</div>

</div>

</body>

</html>

<?php

exit;

}else{

    $stmt=$pdo->prepare("
        UPDATE payments
        SET status='failed'
        WHERE authority=?
    ");

    $stmt->execute([$authority]);

    showMessage(
        "پرداخت ناموفق",
        "پرداخت تأیید نشد. در صورت کسر وجه، مبلغ معمولاً طی چند ساعت تا حداکثر ۷۲ ساعت به حساب شما بازمی‌گردد.",
        "danger",
        '<a href="payment.php" class="btn btn-danger">تلاش مجدد</a>'
    );

}