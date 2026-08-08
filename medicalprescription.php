<?php
require 'config.php';
$medicines = require 'medicines.php';
is_login();

$stmt = $pdo->prepare("SELECT is_paid FROM users WHERE id=?");
$stmt->execute([$_SESSION['user_id']]);

$user = $stmt->fetch();

if ($user['is_paid'] != 1) {
    header("Location: payment.php");
    exit;
}

$user_id = $_SESSION['user_id'];

function getForm($pdo, $table, $user_id)
{
    $stmt = $pdo->prepare("
        SELECT res, type
        FROM `$table`
        WHERE user_id = ?
        ORDER BY id DESC
        LIMIT 1
    ");

    $stmt->execute([$user_id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$oilyform      = getForm($pdo, "oilyform", $user_id);
$sensitiveform = getForm($pdo, "sensitiveform", $user_id);
$pigmentedform = getForm($pdo, "pigmentedform", $user_id);
$wrinkledform  = getForm($pdo, "wrinkledform", $user_id);

if (!$oilyform || !$sensitiveform || !$pigmentedform || !$wrinkledform) {
?>
    <!DOCTYPE html>
    <html lang="fa" dir="rtl">

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
    </head>

    <body class="bg-light">

        <div class="container min-vh-100 d-flex justify-content-center align-items-center">
            <div class="card shadow border-0 rounded-4 p-4 text-center" style="max-width:500px;">
                <h3 class="text-warning mb-3">⚠️ پرسشنامه‌ها کامل نشده‌اند</h3>
                <p>ابتدا باید تمام پرسشنامه‌ها را تکمیل کنید.</p>
                <a href="dashboard.php" class="btn btn-primary">
                    بازگشت به داشبورد
                </a>
            </div>
        </div>

    </body>

    </html>
<?php
    exit;
}


$skinCode =
    $oilyform['type'] .
    $sensitiveform['type'] .
    $pigmentedform['type'] .
    $wrinkledform['type'];


$stmt = $pdo->prepare("
    SELECT title, short_description, full_description, code
    FROM skin_types
    WHERE code = ?
    LIMIT 1
");

$stmt->execute([$skinCode]);

$prescription = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$prescription) {
    die("نسخه‌ای برای این نوع پوست پیدا نشد.");
}

if (isset($medicines[$skinCode])) {
    $medicine = $medicines[$skinCode];
} else {
    die('نسخه‌ای برای این نوع پوست تعریف نشده است.');
}
?>

<!doctype html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>پوستوشناس | نسخه اختصاصی</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="./assets/stylemedicalprescription.css">
    <link rel="stylesheet" href="./assets/style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <main class="container py-4 py-lg-5">
        <section class="row g-4 align-items-stretch intro">
            <div class=" order-lg-1 custom-row col-12">
                <aside class="skin-card h-100">
                    <div class="skin-type">نوع پوست شما</div><strong><?= $skinCode ?></strong>
                    <p><?= $prescription['title'] ?></p>
                    <div class="traits">
                        <div>
                            <span class="icon iconb">
                                <?= file_get_contents('assets/icons/activity.svg'); ?>
                            </span>
                            <span>استعداد چروک<br><?= $wrinkledform['res'] ?? 'نتیجه‌ای ثبت نشده است' ?></span>
                        </div>
                        <div>
                            <span class="icon iconb">
                                <?= file_get_contents('assets/icons/brightness-alt-low.svg'); ?>
                            </span>
                            <span>لک و تیرگی<br><?= $pigmentedform['res'] ?? 'نتیجه‌ای ثبت نشده است' ?></span>
                        </div>
                        <div>
                            <span class="icon iconb">
                                <?= file_get_contents('assets/icons/leaf.svg'); ?>
                            </span>
                            <span>حساسیت<br><?= $sensitiveform['res'] ?? 'نتیجه‌ای ثبت نشده است' ?></span>
                        </div>
                        <div>
                            <span class="icon iconb">
                                <?= file_get_contents('assets/icons/droplet-half.svg'); ?>
                            </span>
                            <span>چربی<br><?= $oilyform['res'] ?? 'نتیجه‌ای ثبت نشده است' ?></span>
                        </div>
                    </div>
                </aside>
            </div>
            <div class=" order-lg-2 col-12">
                <article class="panel analysis h-100">
                    <h1>
                        <span class="icon">
                            <?= file_get_contents('assets/icons/card-text.svg'); ?>
                        </span>
                        تحلیل وضعیت پوست شما
                    </h1>
                    <p><?= $prescription['full_description'] ?></p>
                </article>
            </div>
        </section>

        <h2 class="section-title">نسخه اختصاصی شما</h2>
        <section class="row g-3 prescriptions">
            <div class="col-lg-6">
                <article class="prescription international">
                    <div class="card-head"><span>◎</span> نسخه برندهای بین‌المللی</div>
                    <!-- <div class="products product-int">
                        <div class="products-image">
            <img src="./assets/images/1 (3).png" alt="محصولات پوستی">
          </div>
                    </div> -->
                    <div class="routine">
                        <div class="routine-row">
                            <span class="icon period">
                                <?= file_get_contents('assets/icons/sun.svg'); ?>
                            </span>

                            <ol>
                                <?php foreach ($medicine['version_2']['morning'] as $item) { ?>
                                    <li>
                                        <strong><?= htmlspecialchars($item['product']) ?></strong>
                                        <span><?= htmlspecialchars($item['usage']) ?></span>
                                    </li>
                                <?php } ?>
                            </ol>
                        </div>
                        <div class="routine-row">
                            <span class="icon period">
                                <?= file_get_contents('assets/icons/moon.svg'); ?>
                            </span>
                            <ol>
                                <?php foreach ($medicine['version_2']['night'] as $item) { ?>
                                    <li>
                                        <strong><?= htmlspecialchars($item['product']) ?></strong>
                                        <span><?= htmlspecialchars($item['usage']) ?></span>
                                    </li>
                                <?php } ?>
                            </ol>
                        </div>
                    </div><a href="#" class="details">مشاهده جزئیات محصولات <span>←</span></a>
                </article>
            </div>
            <div class="col-lg-6">
                <article class="prescription iranian">
                    <div class="card-head"><span>🇮🇷</span> نسخه ایرانی</div>
                    <!-- <div class="products product-ir"><i class="bottle pump">Vitalayer<small>Sensivit</small></i><i class="bottle tube green">PRIME<small>ACNEX</small></i><i class="bottle tube orange">PRIME<small>SPF 50</small></i><i class="bottle dropper">PRIME</i><i class="bottle jar">PRIME</i></div> -->
                    <div class="routine">
                        <div class="routine-row">
                            <span class="icon period">
                                <?= file_get_contents('assets/icons/sun.svg'); ?>
                            </span>
                            <ol>
                                <?php foreach ($medicine['version_1']['morning'] as $item) { ?>
                                    <li>
                                        <strong><?= htmlspecialchars($item['product']) ?></strong>
                                        <span><?= htmlspecialchars($item['usage']) ?></span>
                                    </li>
                                <?php } ?>
                            </ol>
                        </div>
                        <div class="routine-row">
                            <span class="icon period">
                                <?= file_get_contents('assets/icons/moon.svg'); ?>
                            </span>
                            <ol>
                                <?php foreach ($medicine['version_1']['night'] as $item) { ?>
                                    <li>
                                        <strong><?= htmlspecialchars($item['product']) ?></strong>
                                        <span><?= htmlspecialchars($item['usage']) ?></span>
                                    </li>
                                <?php } ?>
                            </ol>
                        </div>
                    </div><a href="#" class="details">مشاهده جزئیات محصولات <span>←</span></a>
                </article>
            </div>
        </section>
        <!-- <aside class="doctor-note"><span class="doctor">♙</span>
            <div><strong>توجه دکتر داور</strong><br>این نسخه فقط بر اساس پرسشنامه و تحلیل علمی پوستتان تهیه شده است.<br>در صورت داشتن بیماری پوستی خاص یا بارداری، قبل از تغییر روتین با پزشک خود مشورت کنید.</div>
        </aside> -->
    </main>
    <?php include 'footer.php'; ?>
    <script src="./assets/css/bootstrap.bundle.min.js"></script>
</body>

</html>