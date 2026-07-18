<?php
require 'config.php';
$medicines = require 'medicines.php';
is_login();

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

// اگر یکی از فرم‌ها وجود نداشت
if (!$oilyform || !$sensitiveform || !$pigmentedform || !$wrinkledform) {
    die("ابتدا باید تمام پرسشنامه‌ها را تکمیل کنید.");
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

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نسخه مراقبت از پوست</title>

    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <!-- Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

</head>

<body class="medicalprescription">

    <!-- Header -->
    <header class="app-header">
        <div class="container-max mx-auto h-100 px-3 px-md-0 d-flex align-items-center justify-content-between" style="margin:auto;">
            <div class="d-flex flex-column">
                <h1>نسخه مراقبت از پوست</h1>
                <p>نتیجه تحلیل پوست و روتین پیشنهادی</p>
            </div>
            <a href="dashboard.php" class="btn-outline-primary-custom">
                <span class="icon" style="font-size:20px;">
                    <?= file_get_contents('assets/icons/box-arrow.svg'); ?>
                </span>
                ورود به داشبورد
            </a>
        </div>
    </header>

    <main class="container-max flex-grow-1 mx-auto w-100 py-5 px-3 px-md-0 d-flex flex-column gap-4" style="margin:auto;">

        <!-- نوع پوست -->
        <section class="card-panel d-flex flex-column flex-md-row align-items-center gap-4 skin-type-row">
            <div class="flex-grow-1 w-100">
                <div class="section-title mb-4">
                    <span class="icon">
                        <?= file_get_contents('assets/icons/Heading.svg'); ?>
                    </span>
                    <h2>نوع پوست شما</h2>
                </div>
                <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                    <span class="skin-type-code">
                        <?= $skinCode ?>
                    </span>
                    <div class="divider-vertical"></div>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="pill pill-error"><?= $prescription['title'] ?></span>
                    </div>
                </div>
                <p class="text-muted-custom" style="font-size:18px; line-height:1.8;">
                    <?= $prescription['short_description'] ?>
                </p>
            </div>
            <div class="w-100" style="max-width: 320px;">
                <div class="skin-image-wrap">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuB2pV4gMzJEkIizWN1Bb5BrtxkCPPcMvqLuAbz9N9nlArjYMycM00Du-4ZtG4LKWZNAgrijOdWNLFPMTqWY3pRpoKE8Hwhb4fdJyeoH-8GTspwtxU7OvUUUiLV1RKfkdtcvOGynXvl58DzNv_h1DSp6qSwGEYPfUGqClw39AAKMCUXJk1wZfpvcP5E1QYxdCmAb8fqIB4DbHz-1r7x8JeNS5-E8hwKX60BE93OusiYqs2xgt6Je1o-3cvsfRtvY7fsMjWU2dJWn79w" alt="skincare bottle">
                </div>
            </div>
        </section>

        <!-- توضیح پوست -->
        <section class="card-panel">
            <div class="section-title mb-4">
                <span class="icon">
                    <?= file_get_contents('assets/icons/file-text.svg'); ?>
                </span>
                <h2>توضیح وضعیت پوست</h2>
            </div>
            <div class="text-muted-custom d-flex flex-column gap-3" style="font-size:16px; line-height:1.7 text-align: justify;;">
                <p>
                    <span class="text-primary-custom fw-bold">تیپ پوستی <?= $skinCode ?></span>
                    <span class="text fw-bold"><?= $prescription['full_description'] ?></span>
                </p>
            </div>
        </section>

        <!-- نکته ها-->
        <section class="card-panel">
            <div class="section-title mb-4">
                <span class="icon">
                    <?= file_get_contents('assets/icons/chat-square-text.svg'); ?>
                </span>
                <h2>نکات مهم</h2>
            </div>
            <div class="row g-3">
                <div class="col-12 col-md-4">
                    <div class="note-box note-primary">
                        <span class="text-primary-custom fw-bold fs-5">📌</span>
                        <p class="text-muted-custom mb-0" style="font-size:15px; text-align: justify;">اقلام اشاره شده در روتین پوستی، در کنار یکدیگر به سلامت پوست شما کمک می‌کنند.استفاده ناقص یا نامنظم از روتین ممکن است باعث کاهش اثر بخشی شود.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="note-box note-warning">
                        <span class="fw-bold fs-5" style="color:#F59E0B;">📌</span>
                        <p class="text-muted-custom mb-0" style="font-size:15px; text-align: justify;">در صورت استفاده منظم طبق دستور، نتایج اولیه معمولا بعد از ۶تا۸ هفته قابل مشاهده است.این زمان بسته به نوع پوست و شرایط فردی ممکن است متفاوت باشد.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="note-box note-error">
                        <span class="fw-bold fs-5" style="color:var(--color-error);">📌</span>
                        <p class="text-muted-custom mb-0" style="font-size:15px; text-align: justify;">سرم ها و تونر ها مرحله تکمیلی روتین پوستی هستند و براساس نیاز پوست مانند لک و جای جوش،خشکی پوست،کدری یا ناهمواری پوست اضافه می‌شوند.این محصولات در صورت نیاز و پس از ارزیابی روتین پایه توصیه میشود.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="note-box note-error">
                        <span class="fw-bold fs-5" style="color:var(--color-error);">📌</span>
                        <p class="text-muted-custom mb-0" style="font-size:15px; text-align: justify;">هر محصول پوستی ممکن است در برخی افراد باعث واکنش حساسیتی شود . در صورت مشاهده علائم:قرمزی شدید،خارش،سوزش،التهاب مصرف محصولات را متوقف کرده و با پزشک مشورت نمایید. </p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="note-box note-error">
                        <span class="fw-bold fs-5" style="color:var(--color-error);">📌</span>
                        <p class="text-muted-custom mb-0" style="font-size:15px; text-align: justify;">از شما دعوت میشود پس از هشت هفته استفاده منظم از روتین تجربه خود را ثبت کنید.در صورت نیاز به بررسی دقیق تر امکان ویزیت آنلاین با پزشک از طریق پروفایل فراهم است.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="note-box note-error">
                        <span class="fw-bold fs-5" style="color:var(--color-error);">📌</span>
                        <p class="text-muted-custom mb-0" style="font-size:15px; text-align: justify;">
                            کلیت استفاده از محصولات روتین پوستی به ترتیب زیر است:
                            روتین روز:شست و شو، تونر،سرم روزانه طبق دستور،کرم روز، کرم ضد آفتاب
                            روتین شب:شست و شو،تونر، سرم طبق دستور ،کرم شب
                            این روتین به عنوان راهنمای عمومی مراقبت از پوست ارایه شده.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- روتین -->
        <section class="card-panel">
            <div class="section-title mb-5">
                <span class="icon">
                    <?= file_get_contents('assets/icons/postcard-heart.svg'); ?>
                </span>
                <h2>ترتیب صحیح استفاده از محصولات</h2>
            </div>
            <div class="row gy-5">
                <div class="col-lg-6">
                    <div class="timeline-heading day">
                        <span class="icon" style="font-variation-settings: 'FILL' 1;">
                            <?= file_get_contents('assets/icons/brightness-high-fill.svg'); ?>
                        </span>
                        <span>نسخه اول: نسخه  پوستی شما با برند های ایرانی</span>
                    </div>
                    <!-- Day Routine -->
                    <div class="timeline-list d-flex flex-wrap gap-3">
                        <div class="timeline-heading day">
                            <span class="icon" style="font-variation-settings: 'FILL' 1;">
                                <?= file_get_contents('assets/icons/brightness-high-fill.svg'); ?>
                            </span>
                            <span>روتین روز</span>
                        </div>
                        <div class="timeline-list">
                            <?php foreach ($medicine['version_1']['morning'] as $item) { ?>
                                <div class="timeline-item">
                                    <span class="timeline-dot dot-active-primary"></span>
                                    <div class="timeline-label label-solid-primary">
                                        <?= htmlspecialchars($item['product']) ?>
                                    </div>
                                    <div class="timeline-label label-inactive">
                                        <?= htmlspecialchars($item['usage']) ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- Night Routine -->
                    <div class="timeline-list d-flex flex-wrap gap-3">
                        <div class="timeline-heading night">
                            <span class="icon" style="font-variation-settings: 'FILL' 1;">
                                <?= file_get_contents('assets/icons/moon-stars-fill.svg'); ?>
                            </span>
                            <span>روتین شب</span>
                        </div>

                        <div class="timeline-list">
                            <?php foreach ($medicine['version_1']['night'] as $item) { ?>
                                <div class="timeline-item">
                                    <span class="timeline-dot dot-active-primary"></span>
                                    <div class="timeline-label label-solid-primary">
                                        <?= htmlspecialchars($item['product']) ?>
                                    </div>
                                    <div class="timeline-label label-inactive">
                                        <?= htmlspecialchars($item['usage']) ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="timeline-heading day">
                        <span class="icon" style="font-variation-settings: 'FILL' 1;">
                            <?= file_get_contents('assets/icons/brightness-high-fill.svg'); ?>
                        </span>
                        <span>نسخه دوم:نسخه پوستی شما با برند منتخب بین الملی</span>
                    </div>
                    <!-- Day Routine -->
                    <div class="timeline-list d-flex flex-wrap gap-3">
                        <div class="timeline-heading day">
                            <span class="icon" style="font-variation-settings: 'FILL' 1;">
                                <?= file_get_contents('assets/icons/brightness-high-fill.svg'); ?>
                            </span>
                            <span>روتین روز</span>
                        </div>
                        <div class="timeline-list">
                            <?php foreach ($medicine['version_2']['morning'] as $item) { ?>
                                <div class="timeline-item">
                                    <span class="timeline-dot dot-active-primary"></span>
                                    <div class="timeline-label label-solid-primary">
                                        <?= htmlspecialchars($item['product']) ?>
                                    </div>
                                    <div class="timeline-label label-inactive">
                                        <?= htmlspecialchars($item['usage']) ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- Night Routine -->
                    <div class="timeline-list d-flex flex-wrap gap-3">
                        <div class="timeline-heading night">
                            <span class="icon" style="font-variation-settings: 'FILL' 1;">
                                <?= file_get_contents('assets/icons/moon-stars-fill.svg'); ?>
                            </span>
                            <span>روتین شب</span>
                        </div>

                        <div class="timeline-list">
                            <?php foreach ($medicine['version_2']['night'] as $item) { ?>
                                <div class="timeline-item">
                                    <span class="timeline-dot dot-active-primary"></span>
                                    <div class="timeline-label label-solid-primary">
                                        <?= htmlspecialchars($item['product']) ?>
                                    </div>
                                    <div class="timeline-label label-inactive">
                                        <?= htmlspecialchars($item['usage']) ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                </div>

            </div>

            </div>
        </section>

        <!-- Footer -->
        <footer class="app-footer">
            <div class="d-flex flex-column align-items-center gap-3">
                <div class="footer-badge">
                    <span class="material-symbols-outlined" style="font-size:18px;">verified_user</span>
                    <span>تاییدیه تیم پزشکی کلینیک</span>
                </div>
                <p class="text-muted-custom mb-0" style="font-size:13px; max-width:640px;">
                    این نسخه صرفاً به عنوان راهنمای مراقبت از پوست بر اساس تحلیل‌های هوشمند ارائه شده است و جایگزین تشخیص حضوری پزشک در موارد خاص نمی‌باشد. کلیه محصولات معرفی شده دارای تاییدیه سازمان غذا و دارو هستند.
                </p>
                <div class="footer-divider"></div>
                <div class="d-flex gap-4 footer-links">
                    <a href="#">شرایط استفاده</a>
                    <a href="#">حریم خصوصی</a>
                    <a href="#">تماس با پشتیبانی</a>
                </div>
                <p class="mb-0 mt-2" style="font-size:13px; color: var(--color-outline); opacity:0.6;">© ۱۴۰۲ تمامی حقوق برای کلینیک تخصصی پوست محفوظ است.</p>
            </div>
        </footer>

    </main>

    <div class="bg-blob blob-top-right"></div>
    <div class="bg-blob blob-bottom-left"></div>


</body>

</html>