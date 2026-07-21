<?php
require 'config.php';
is_login();

$stmt = $pdo->prepare("SELECT is_paid FROM users WHERE id=?");
$stmt->execute([$_SESSION['user_id']]);

$user = $stmt->fetch();

if ($user['is_paid'] == 1) {
    header("Location: Oilyform.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>پرداخت آزمون</title>

    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="assets/style.css">


</head>

<body class="body-payment">

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-7 col-lg-5">

            <div class="card payment-card">

                <div class="payment-header">

                    <h3 class="mt-3">
                        پرداخت هزینه آزمون
                    </h3>

                </div>

                <div class="card-body p-4 text-center card-payment">

                    <p class="mb-4">

                        برای شروع آزمون ابتدا لازم است هزینه آزمون را پرداخت کنید.
                        پس از پرداخت موفق، دسترسی شما به پرسشنامه به صورت خودکار فعال خواهد شد.

                    </p>

                    <div class="alert alert-info card-payment">

                         پرداخت از طریق درگاه امن زرین‌پال انجام می‌شود.

                    </div>

                    <form action="pay.php" method="post">

                        <button class="btn btn-pay w-100 card-payment">

                            پرداخت و شروع آزمون

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>