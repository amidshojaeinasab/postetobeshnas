<?php
require 'config.php';
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
        <button class="btn-outline-primary-custom">
            <span class="material-symbols-outlined" style="font-size:20px;">
      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
  <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
</svg>
            </span>
            <span>بازگشت به داشبورد</span>
        </button>
    </div>
</header>

<main class="container-max flex-grow-1 mx-auto w-100 py-5 px-3 px-md-0 d-flex flex-column gap-4" style="margin:auto;">

    <!-- Card 1: Skin Type Analysis -->
    <section class="card-panel d-flex flex-column flex-md-row align-items-center gap-4 skin-type-row">
        <div class="flex-grow-1 w-100">
            <div class="section-title mb-4">
                <span class="material-symbols-outlined">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-flask-fill" viewBox="0 0 16 16">
  <path d="M11.5 0a.5.5 0 0 1 0 1H11v5.358l4.497 7.36c.099.162.16.332.192.503l.013.063.008.083q.006.053.007.107l-.003.09q-.001.047-.005.095-.006.053-.017.106l-.016.079q-.012.049-.028.096l-.028.086a1.5 1.5 0 0 1-.17.322 1.5 1.5 0 0 1-.395.394q-.04.028-.082.054-.045.026-.095.049l-.073.035-.09.033q-.05.02-.103.034-.04.01-.08.017-.053.012-.108.021l-.006.002-.202.013H1.783l-.214-.015a1.503 1.503 0 0 1-1.066-2.268L5 6.359V1h-.5a.499.499 0 0 1-.354-.854A.5.5 0 0 1 4.5 0zm.5 12a.5.5 0 0 0 0 1h1.885l-.61-1zm-1-2a.5.5 0 0 0 0 1h1.664l-.612-1zm-1-2a.5.5 0 0 0 0 1h1.441l-.61-1zM9 6a.5.5 0 0 0 0 1h1.22l-.147-.24A.5.5 0 0 1 10 6.5V6zm0-2a.5.5 0 0 0 0 1h1V4zm0-2a.5.5 0 0 0 0 1h1V2z"/>
</svg>
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

    <!-- Card 2: Medical Explanation -->
    <section class="card-panel">
        <div class="section-title mb-4">
            <span class="material-symbols-outlined">
   <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-text-fill" viewBox="0 0 16 16">
  <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1m-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5M5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1m0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1"/>
</svg>
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

    <!-- Card 3: Recommended Routine -->
    <!-- <section>
        <div class="section-title mb-4">
            <span class="material-symbols-outlined">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0"/>
</svg>
            </span>
            <h2>روتین پیشنهادی</h2>
        </div>
        <div class="row g-3">
            
            <div class="col-12 col-md-4">
                <div class="product-card">
                    <div class="product-img-wrap">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBlYBBQx-gExDF7YeHtdIK7PeD3Uc6cbESxQF5W6DJ58zjjDmTXP7cv1LrtwG-kbqYARiJLlHwEcu2w_oBpCw8Gch91wxX8gxnQMwRnloqLCcx-v5bNo-BhrJ87xrlWokONEBrFR9aqnzktRHbQNTd3CxsHcRMES_VSdGNAUnMcE4U5TvyFAZtFZ-BkrXViLMrjXN_CLXySvmx5g1N36QwcVcDtfn3lCZTABKnZ5ANXyRgo-vOLLPwwW_RibA03nBaEjRpTwhHF1b8" alt="Face Wash">
                        <span class="product-badge">۱</span>
                    </div>
                    <h3 class="fw-bold mb-2" style="font-size:16px;">Vitalayer Sensivit Face Wash Gel</h3>
                    <div class="product-time-pill">
                        <span class="material-symbols-outlined" style="font-size:18px;">schedule</span>
                        <span>صبح و شب</span>
                    </div>
                    <p class="text-muted-custom fst-italic" style="font-size:13px;">شوینده ملایم فاقد مواد صابونی برای کاهش التهاب و پاکسازی عمقی منافذ.</p>
                </div>
            </div>
           
            <div class="col-12 col-md-4">
                <div class="product-card">
                    <div class="product-img-wrap">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCv0yU3pkRyw0YWmGuon37r7Jobj8eFyp8Z0rmOLW02coT1BaVUo-tvW_iH0rTs-G7MrapdPsJlYkxV0cArcHWbORAhVnBvAplL5vdE9V8AgBcecHDuAK40lbzXzJQdwba0l1W_fGMQOAHsawuidTMjN8AFJCUHr7S0tnzP4o9PEOsoFOJcWf6CJqdvE7PQ1y0hymJ9ZlnyYeQCoAxLromi38pJef6r4RAYsXaLBgOKYCqiPyiyqR8hGJNpJeNfES0l9AXYJaQEMfA" alt="Cream">
                        <span class="product-badge">۲</span>
                    </div>
                    <h3 class="fw-bold mb-2" style="font-size:16px;">Prime Moist 24H Cream</h3>
                    <div class="product-time-pill">
                        <span class="material-symbols-outlined" style="font-size:18px;">water_drop</span>
                        <span>بعد از شستشو</span>
                    </div>
                    <p class="text-muted-custom fst-italic" style="font-size:13px;">کرم آبرسان قوی با ماندگاری بالا جهت بازسازی لایه محافظ پوست خشک.</p>
                </div>
            </div>
           
            <div class="col-12 col-md-4">
                <div class="product-card">
                    <div class="product-img-wrap">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuByodGoskZaKjus24JnyDyU-cpP_4kX_3rCTSFFT26nqJjajOGuIbUPGNWgMWmIf57uwr4JKtByvpccCVZonUlEIEB6LX5DuMJjlAKcDDTb-6Y7v4ulHfIqxghIT0ODadtSCGG8hm1LwxkdnFTWU6JP9RtbeRpt2m47fr3uo1Z5aDLJpeNb2UpxQJ--ObIDFdjI3lC0dfXA9zen0X7ymrP4XGs2YiLi7DcO4O1wFMasSe4xHF2eQ_xx9WzsTT0crhhGvfkLR907iDw" alt="Sunscreen">
                        <span class="product-badge">۳</span>
                    </div>
                    <h3 class="fw-bold mb-2" style="font-size:16px;">Prime SPF50 Sunscreen</h3>
                    <div class="product-time-pill">
                        <span class="material-symbols-outlined" style="font-size:18px;">light_mode</span>
                        <span>روزها</span>
                    </div>
                    <p class="text-muted-custom fst-italic" style="font-size:13px;">محافظت کامل در برابر اشعه‌های مضر برای جلوگیری از لک و پیری زودرس.</p>
                </div>
            </div>
        </div>
    </section> -->

    
    <section class="card-panel">
        <div class="section-title mb-4">
            <span class="material-symbols-outlined">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chat-square-text-fill" viewBox="0 0 16 16">
                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1z"/></svg>
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
                    <p class="text-muted-custom mb-0" style="font-size:15px; text-align: justify;">سرم ها  و تونر ها مرحله تکمیلی روتین پوستی هستند و براساس نیاز پوست مانند لک و جای جوش،خشکی پوست،کدری یا ناهمواری پوست اضافه می‌شوند.این محصولات در صورت نیاز و پس از ارزیابی روتین پایه توصیه میشود.</p>
                </div>
            </div>
             <div class="col-12 col-md-4">
                <div class="note-box note-error">
                    <span class="fw-bold fs-5" style="color:var(--color-error);">📌</span>
                    <p class="text-muted-custom mb-0" style="font-size:15px; text-align: justify;">هر محصول پوستی ممکن است در برخی افراد باعث واکنش حساسیتی شود . در صورت مشاهده علائم:قرمزی شدید،خارش،سوزش،التهاب مصرف محصولات را متوقف کرده و با پزشک مشورت نمایید.  </p>
                </div>
            </div>
             <div class="col-12 col-md-4">
                <div class="note-box note-error">
                    <span class="fw-bold fs-5" style="color:var(--color-error);">📌</span>
                    <p class="text-muted-custom mb-0" style="font-size:15px; text-align: justify;">در صورت عدم مشاهده نتیجه یا نیاز به تنظیم مجدد روتین توصیه میشود،پس از هشت هفته استفاده منظم نتیجه را ارزیابی کرده و در صورت نیاز با متخصص پوست مشاوره انجام شود.</p>
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
                    <p class="text-muted-custom mb-0" style="font-size:15px; text-align: justify;">کلیت استفاده از محصولات روتین پوستی به ترتیب زیر است:
 روتین روز:شست و شو، تونر،سرم روزانه طبق دستور،کرم روز، کرم ضد آفتاب 
روتین شب:شست و شو،تونر، سرم طبق دستور ،کرم شب
این روتین به عنوان راهنمای عمومی مراقبت از پوست ارایه شده.
</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Card 5: Routine Order (Timeline) -->
    <section class="card-panel">
        <div class="section-title mb-5">
            <span class="material-symbols-outlined">
           <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-postcard-heart-fill" viewBox="0 0 16 16">
  <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm6 2.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0m3.5.878c1.482-1.42 4.795 1.392 0 4.622-4.795-3.23-1.482-6.043 0-4.622M2 5.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5"/>
</svg>
            </span>
            <h2>ترتیب صحیح استفاده از محصولات</h2>
        </div>
        <div class="row g-5">
            <!-- Day Routine -->
            <div class="col-12 col-lg-4">
                <div class="timeline-heading day">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-brightness-high-fill" viewBox="0 0 16 16">
  <path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"/>
</svg>
                    </span>
                    <span>روتین روز</span>
                </div>
                <div class="timeline-list">
                    <div class="timeline-item">
                        <span class="timeline-dot dot-active-primary"></span>
                        <div class="timeline-label label-active-primary">شستشو</div>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-dot dot-inactive"></span>
                        <div class="timeline-label label-inactive">تونر (اختیاری)</div>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-dot dot-inactive"></span>
                        <div class="timeline-label label-inactive">سرم</div>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-dot dot-active-primary"></span>
                        <div class="timeline-label label-active-primary">مرطوب‌کننده</div>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-dot dot-active-primary"></span>
                        <div class="timeline-label label-solid-primary">ضد آفتاب</div>
                    </div>
                </div>
            </div>
            <!-- Night Routine -->
            <div class="col-12 col-lg-4">
                <div class="timeline-heading night">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-moon-stars-fill" viewBox="0 0 16 16">
  <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278"/>
  <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.73 1.73 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.73 1.73 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.73 1.73 0 0 0 1.097-1.097zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z"/>
</svg>
                    </span>
                    <span>روتین شب</span>
                </div>
                <div class="timeline-list">
                    <div class="timeline-item">
                        <span class="timeline-dot dot-active-secondary"></span>
                        <div class="timeline-label label-active-secondary">شستشو</div>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-dot dot-inactive"></span>
                        <div class="timeline-label label-inactive">تونر</div>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-dot dot-active-secondary"></span>
                        <div class="timeline-label label-active-secondary">سرم درمانی</div>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-dot dot-active-secondary"></span>
                        <div class="timeline-label label-solid-secondary">مرطوب‌کننده</div>
                    </div>
                </div>
            </div>
             
<!-- Day Night Routine -->
            <div class="col-12 col-lg-4">
                <div class="timeline-heading day">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-brightness-high-fill" viewBox="0 0 16 16">
  <path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"/>
</svg>
                    </span>
                    <span>روتین روز و شب</span>
                </div>
                <div class="timeline-list">
                    <div class="timeline-item">
                        <span class="timeline-dot dot-active-primary"></span>
                        <div class="timeline-label label-active-primary">شستشو</div>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-dot dot-inactive"></span>
                        <div class="timeline-label label-inactive">تونر (اختیاری)</div>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-dot dot-inactive"></span>
                        <div class="timeline-label label-inactive">سرم</div>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-dot dot-active-primary"></span>
                        <div class="timeline-label label-active-primary">مرطوب‌کننده</div>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-dot dot-active-primary"></span>
                        <div class="timeline-label label-solid-primary">ضد آفتاب</div>
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

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>