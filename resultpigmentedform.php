<?php
require 'config.php';
is_login();

$user_id = $_SESSION['user_id'];

function getForm($pdo, $table, $user_id)
{
    $stmt = $pdo->prepare("
        SELECT `res`, `type`
        FROM `$table`
        WHERE user_id = ?
        ORDER BY id DESC
        LIMIT 1
    ");

    $stmt->execute([$user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getSkinType($code)
{
    $types = [
        'O' => 'چرب',
        'D' => 'خشک',
        'S' => 'حساس',
        'R' => 'مقاوم',
        'P' => 'رنگدانه‌دار',
        'N' => 'غیررنگدانه‌دار',
        'T' => 'سفت',
        'W' => 'چروکیده',
    ];

    if (empty($code)) {
        return 'نامشخص';
    }

    return $types[strtoupper($code)] ?? 'نامشخص';
}


$pigmentedform = getForm($pdo, "pigmentedform", $user_id);
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نتیجه آنالیز پوست</title>

    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="assets/style.css">

</head>

<body class="body-res">

    <div class="card result-card">
        <div class="card-body p-5 text-center">

            <h5 class="text-muted mb-3">نتیجه آنالیز پوست</h5>

            <!-- نوع پوست -->
            <div class="mb-4">
                <div class="skin-type">نوع پوست شما: <?= getSkinType($pigmentedform['type'] ?? '') ?></div>
                <!-- <small class="text-muted">نوع پوست شما</small> -->
            </div>

            <!-- امتیاز -->
            <div class="mb-4">
                <div class="score"><?= $pigmentedform['res'] ?? 'نتیجه‌ای ثبت نشده است' ?></div>
                <small class="text-muted">از 100</small>
            </div>

            <!-- توضیح امتیاز -->
            <div class="mb-5 text-center">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title mb-4">تفسیر امتیاز پوست</h5>

                        <ul class="list-group list-group-flush text-start">
                            <li class="list-group-item">
                                اگر امتیاز بین <strong>۲۹ تا ۵۲ </strong> باشد: نوع پوست شما P (رنگدانه‌دار) است.
                            </li>
                            <li class="list-group-item">
                                اگر امتیاز بین <strong>۱۳ تا ۲۸</strong> باشد: نوع پوست شما N (غیررنگدانه‌دار) است.
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <!-- دکمه -->
            <a href="dashboard.php" class="btn btn-outline-custom btn-lg px-5 w-100">
                ورود به داشبورد
            </a>

        </div>
    </div>

</body>

</html>