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
    
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
}

function getSkinType($code)
{
    if (empty($code)) {
        return 'نتیجه‌ای ثبت نشده است';
    }

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

    return $types[strtoupper($code)] ?? 'نامشخص';
}

$oilyform = getForm($pdo, "oilyform", $user_id);
$sensitiveform = getForm($pdo, "sensitiveform", $user_id);
$pigmentedform = getForm($pdo, "pigmentedform", $user_id);
$wrinkledform = getForm($pdo, "wrinkledform", $user_id);
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>داشبورد</title>
</head>

<body class="bg-light m-0 p-0">
    <div class="container-fluid">
        <div class="row min-vh-100">
            <!-- Sidebar -->
            <div class="col-12 col-md-3 col-lg-2 bg-dark text-white p-0">

                <div class="p-4 border-bottom border-secondary text-center">
                    <h4 class="fw-bold mb-0">
                        پنل کاربری
                    </h4>
                </div>

                <ul class="nav flex-column p-3">

                    <li class="nav-item mb-2">
                        <ul class="nav flex-column p-3">
                           <span>پرسشنامه ها</span>
                            <li class="nav-item mb-2 dashboard-btn"><a class="nav-link text-white " href="Oilyform.php">پوست چرب/خشک</a></li>
                            <li class="nav-item mb-2 dashboard-btn"><a class="nav-link text-white" href="pigmentedform.php">پوست رنگ دانه دار</a></li>
                            <li class="nav-item mb-2 dashboard-btn"><a class="nav-link text-white" href="sensitiveform.php">پوست حساس</a></li>
                            <li class="nav-item mb-2 dashboard-btn"><a class="nav-link text-white" href="wrinkledform.php">پوست چروکیده</a></li>
                        </ul>
                    </li>

                    <li class="nav-item mb-2 dashboard-btn">
                        <a href="profile.php"
                            class="nav-link text-white">

                            <i class="bi bi-gear ms-2"></i>
                           پروفایل

                        </a>
                    </li>

                    <li class="nav-item mt-4 bg-danger border rounded-3">
                        <a href="logout.php"
                            class="nav-link text-white">

                            <i class="bi bi-box-arrow-right ms-2"></i>
                            خروج

                        </a>
                    </li>

                </ul>

            </div>

            <!-- Main Content -->
            <div class="col-12 col-md-9 col-lg-10">

                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg bg-white shadow-sm px-4">

                    <div class="container-fluid">

                        <span class="navbar-brand fw-bold">
                            داشبورد
                        </span>

                        <div class="d-flex align-items-center">

                            <span class="me-3 fw-semibold">
                                <?= $_SESSION["user_name"] ?> خوش آمدید
                            </span>

                            <img src="./assets/images/profile.png"
                                class="rounded-circle"
                                width="40" height="40"
                                alt="profile">

                        </div>

                    </div>

                </nav>

                <div class="row g-4 mt-4">

                    <div class="col-xl-3 col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body ">
                                <div class="text-center d-flex justify-content-between align-items-center">
                                    <p class="text-muted mb-1">پوست چرب/خشک</p>
                                    <h4 class="mb-0"><?= $oilyform['res'] ?? 'نتیجه‌ای ثبت نشده است' ?></h4>
                                </div>
                            </div>

                            <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-success">
                                        
                                        <i class="bx bxs-up-arrow fs-32">نوع پوست <?= getSkinType($oilyform['type'] ?? '') ?></i>
                                    </span>
                                </div>
                                <a href="resultOilyform.php" class="fw-semibold text-decoration-none btn btn-outline-custom">مشاهده</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body ">
                                <div class="text-center d-flex justify-content-between align-items-center">
                                    <p class="text-muted mb-1">پوست حساس در مقابل مقاوم</p>
                                    <h4 class="mb-0"><?= $sensitiveform['res'] ?? 'نتیجه‌ای ثبت نشده است' ?></h4>
                                </div>
                            </div>

                            <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-success">
                                        <i class="bx bxs-up-arrow fs-12">نوع پوست <?= getSkinType($sensitiveform['type'] ?? '') ?></i>
                                    </span>
                                </div>
                                <a href="resultsensitiveform.php" class="fw-semibold text-decoration-none btn btn-outline-custom">مشاهده</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body ">
                                <div class="text-center d-flex justify-content-between align-items-center">
                                    <p class="text-muted mb-1">پوست رنگدانه‌دار در مقابل غیررنگدانه‌دار</p>
                                    <h4 class="mb-0"><?= $pigmentedform['res'] ?? 'نتیجه‌ای ثبت نشده است' ?></h4>
                                </div>
                            </div>

                            <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-success"> 
                                        <i class="bx bxs-up-arrow fs-12">نوع پوست <?= getSkinType($pigmentedform['type'] ?? '') ?></i>
                                    </span>
                                </div>
                                <a href="resultpigmentedform.php" class="fw-semibold text-decoration-none btn btn-outline-custom">مشاهده</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body ">
                                <div class="text-center d-flex justify-content-between align-items-center">
                                    <p class="text-muted mb-1">پوست چروکیده در مقابل سفت</p>
                                    <h4 class="mb-0"><?= $wrinkledform['res'] ?? 'نتیجه‌ای ثبت نشده است' ?></h4>
                                </div>
                            </div>

                            <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-success">
                                        <i class="bx bxs-up-arrow fs-12">نوع پوست <?= getSkinType($wrinkledform['type'] ?? '') ?></i>
                                    </span>
                                </div>
                                <a href="resultwrinkledform.php" class="fw-semibold text-decoration-none btn btn-outline-custom">مشاهده</a>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="container py-5">

    <div class="card intro-card">
        <div class="card-body p-2">

            <h2 class="intro-title text-center mb-4">
                پوست خود را بشناسید
            </h2>

            <div class="intro-text">

                <p>
                    پوست هر فرد ویژگی‌ها، نیازها و واکنش‌های منحصر‌به‌فردی دارد؛
                    به همین دلیل یک روتین مراقبتی مؤثر باید متناسب با شرایط واقعی
                    پوست همان فرد طراحی شود.
                </p>

                <p>
                    در این سامانه، با پاسخ به مجموعه‌ای از پرسش‌های کوتاه و
                    هدفمند، و بر پایه یکی از جامع‌ترین و به‌روزترین رویکردهای
                    طبقه‌بندی پوست، پوست شما بر اساس چهار ویژگی کلیدی شامل
                    <strong>میزان چربی یا خشکی</strong>،
                    <strong>حساسیت‌پذیری</strong>،
                    <strong>استعداد ایجاد لک</strong> و
                    <strong>روند پیری پوست</strong>
                    ارزیابی می‌شود.
                </p>

                <p>
                    پس از تکمیل ارزیابی، پروفایل تخصصی پوست شما به همراه
                    <strong>دو روتین شخصی‌سازی‌شده مراقبت از پوست (روز و شب)</strong>
                    ارائه خواهد شد؛ یک روتین بر پایه محصولات منتخب ایرانی و یک
                    روتین بر اساس برندهای معتبر بین‌المللی.
                </p>

                <p>
                    این سامانه توسط تیم تخصصی
                    <strong>دکتر شهره دلاور</strong>
                    و بر پایه پژوهش‌های علمی طراحی شده است. مبنای این ارزیابی در
                    قالب یک مطالعه پژوهشی با همکاری
                    <strong>مرکز تحقیقات پوست و جذام دانشگاه علوم پزشکی تهران</strong>
                    مورد بررسی قرار گرفته و ارتباط نتایج آن با شاخص‌های عینی و
                    بیومتریک پوست ارزیابی شده است.
                </p>

                <p class="mb-0">
                    هدف ما کمک به شما برای انتخاب آگاهانه‌تر محصولات مراقبت از
                    پوست و دستیابی به پوستی سالم‌تر، شفاف‌تر و جوان‌تر است.
                </p>

            </div>
<a href="medicalprescription.php" class="btn btn-outline-custom btn-lg px-5 w-100 fs-6">
            ورود به نسخه پزشکی
        </a>
        </div>
    </div>

</div>

            </div>

        </div>

    </div>

</body>

</html>