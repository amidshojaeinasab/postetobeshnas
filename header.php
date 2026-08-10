    <nav class="navbar navbar-expand-lg navbar-dark site-nav">
    <div class="container-fluid px-3 px-md-4 px-lg-5">
        <a href="index.php" class="navbar-brand d-flex align-items-center gap-2">
            <img src="./assets/images/logo1.jpg" alt="لوگوی سایت" class="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav mx-auto gap-lg-3">
                <li class="nav-item"><a class="nav-link" href="index.php">خانه</a></li>
                <li class="nav-item"><a class="nav-link" href="coming-soon.php">پرسشنامه</a></li>
                <li class="nav-item"><a class="nav-link" href="medicalprescription.php">نسخه‌ها</a></li>
                <li class="nav-item"><a class="nav-link" href="coming-soon.php">مقالات</a></li>
                <li class="nav-item"><a class="nav-link" href="coming-soon.php">درباره ما</a></li>
                <li class="nav-item"><a class="nav-link" href="contactus.php">تماس با ما</a></li>
            </ul><a class="login-btn" href="<?= !empty($_SESSION['user_id']) ? 'dashboard.php' : 'login.php'; ?>">
               
                <?= !empty($_SESSION['user_id']) ? 'داشبورد' : 'ورود/ثبت نام'; ?>
            </a>
        </div>
    </div>
    </nav>