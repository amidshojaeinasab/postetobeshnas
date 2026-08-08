<?php
require 'config.php';
is_login();

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT is_paid FROM users WHERE id = ?");
$stmt->execute([$user_id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);




$stmt = $pdo->prepare("SELECT is_paid FROM users WHERE id=?");
$stmt->execute([$user_id]);

$user = $stmt->fetch();

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

<!doctype html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>داشبورد پوستتو بشناس</title>
  <link rel="stylesheet" href="./assets/css/bootstrap.rtl.min.css">
  <link rel="stylesheet" href="./assets/style.css">
</head>

<body>
  <div class="sidebar-overlay" id="sidebarOverlay" hidden></div>
  <div class="dashboard-shell">
    <aside class="sidebar" id="sidebar">
      <div class="profile">
        <div class="avatar">
          <span class="icon-dash">
            <?= file_get_contents('assets/icons/person.svg'); ?>
          </span>
        </div>
        <div>
          <?= $_SESSION["user_name"] ?>
          <span>خوش آمدید</span>
        </div>
      </div>
      <nav class="menu">
        <a class="active" href="dashboard.php">
          <span class="icon-dash">
            <?= file_get_contents('assets/icons/house-door.svg'); ?>
          </span>
          <span>داشبورد</span>

        </a>
        <a href="questionnaire.php">
          <span class="icon-dash">
            <?= file_get_contents('assets/icons/card-text.svg'); ?>
          </span>
          <span>پرسشنامه ها</span>
        </a>
        <a href="medicalprescription.php">
          <span class="icon-dash">
            <?= file_get_contents('assets/icons/grid.svg'); ?>
          </span>
          <span>نسخه من</span>
        </a>
        <a href="profile.php">
          <span class=" icon-dash">
          <?= file_get_contents('assets/icons/person-gear.svg'); ?>
          </span>
          <span>پروفایل من</span>
        </a>
        <a href="coming-soon.php">
          <span class="icon-dash">
            <?= file_get_contents('assets/icons/journal-text.svg'); ?>
          </span>
          <span>تاریخچه سفارشات</span>
        </a>
        <a href="coming-soon.php">
          <span class="icon-dash">
            <?= file_get_contents('assets/icons/headset.svg'); ?>
          </span>
          <span>پشتیبانی</span>
        </a>
      </nav>
      <a class="logout" href="logout.php">
        <span class="icon-dash">
          <?= file_get_contents('assets/icons/box-arrow-right.svg'); ?>
        </span>
        <span>خروج</span>

      </a>
    </aside>

    <main class="content">
      <header class="topbar">
        <button class="sidebar-toggle" type="button" id="sidebarToggle" aria-label="باز کردن منو" aria-expanded="false" aria-controls="sidebar">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <div class="brand">
          <a href="index.php" class="navbar-brand d-flex align-items-center gap-2">
            <img src="./assets/images/logo1.jpg" alt="لوگوی سایت" class="logo">
          </a>
        </div>
        <h1>داشبورد پوستتو بشناس</h1>
      </header>

      <section class="hero-dash">
        <div class="hero-dash-art">
          <div class="portrait-wrap"><img src="./assets/images/1 (2).png" alt="مراقبت پوست"></div>
        </div>
        <div class="intro-card">
          <div class="leaf-icon">
            <span>
              <?= file_get_contents('assets/icons/leaf.svg'); ?>
            </span>
          </div>
          <h2>ارزیابی جامع پوست</h2>
          <p>با تکمیل چهار ارزیابی تخصصی پروفایل پوست شما<br>و روتین اختصاصی مراقبت از پوست طراحی می‌شود.</p>
          <!-- <button>
            <span class="icon">
              
            </span>
            فعال‌سازی ارزیابی پوست</button> -->

          <?php if ($user['is_paid'] == 1) { ?>

            <a href="Oilyform.php" class="btn btn-outline-custom btn-lg px-3 py-3 rounded-3 shadow-sm">
              شروع پرسشنامه
            </a>

          <?php } else { ?>

            <a href="payment.php" class="btn btn-outline-custom btn-lg px-3 py-3 rounded-3 shadow-sm">
              فعال سازی ارزیابی پوست
            </a>

          <?php } ?>
          <small>پرداخت امن و سریع</small>
        </div>
      </section>

      <section class="assessments">
        <div class="section-title"><span></span>
          <h2>چهار ارزیابی تخصصی</h2><span></span>
        </div>
        <div class="assessment-grid">
          <article>
            <div class="round peach">
              <span>
                <?= file_get_contents('assets/icons/activity.svg'); ?>
              </span>
            </div>
            <h3>روند پیری پوست</h3>
            <p>بررسی علائم پیری و<br>استعداد به پیری پوست</p>

            <?php if ($user['is_paid'] == 1) { ?>

              <a href="wrinkledform.php" class="btn btn-custom">
                شروع پرسشنامه
              </a>

            <?php } else { ?>

              <a href="payment.php" class="btn btn-custom">
                پس از فعال سازی در دسترس خواهد بود.
              </a>

            <?php } ?>

          </article>
          <article>
            <div class="round sun">
              <span>
                <?= file_get_contents('assets/icons/brightness-alt-low.svg'); ?>
              </span>
            </div>
            <h3>لک و زردیگان</h3>
            <p>بررسی آسیب ناشی از نور<br>و تیرگی پوست</p>

            <?php if ($user['is_paid'] == 1) { ?>

              <a href="pigmentedform.php" class="btn btn-custom">
                شروع پرسشنامه
              </a>

            <?php } else { ?>

              <a href="payment.php" class="btn btn-custom">
                پس از فعال سازی در دسترس خواهد بود.
              </a>

            <?php } ?>
          </article>
          <article>
            <div class="round green">
              <span>
                <?= file_get_contents('assets/icons/leaf.svg'); ?>
              </span>
            </div>
            <h3>حساسیت پوست</h3>
            <p>بررسی علائم حساسیت و<br>واکنش‌پذیری پوست</p>
            <?php if ($user['is_paid'] == 1) { ?>

              <a href="sensitiveform.php" class="btn btn-custom">
                شروع پرسشنامه
              </a>

            <?php } else { ?>

              <a href="payment.php" class="btn btn-custom">
                پس از فعال سازی در دسترس خواهد بود.
              </a>

            <?php } ?>
          </article>
          <article>
            <div class="round blue">
              <span>
                <?= file_get_contents('assets/icons/droplet-half.svg'); ?>
              </span>
            </div>
            <h3>چربی یا خشکی پوست</h3>
            <p>بررسی میزان چربی و<br>تعادل رطوبت پوست</p>
            <?php if ($user['is_paid'] == 1) { ?>

              <a href="Oilyform.php" class="btn btn-custom">
                شروع پرسشنامه
              </a>

            <?php } else { ?>

              <a href="payment.php" class="btn btn-custom">
                پس از فعال سازی در دسترس خواهد بود.
              </a>

            <?php } ?>
          </article>
        </div>
      </section>

      <section class="results-lock">
        <div class="lock-content">
          <b>تایپ پوستی شما تنها پس از تکمیل هر چهار ارزیابی و تحلیل یکپارچه نتایج مشخص خواهد شد.</b>

          <?php if (!$oilyform || !$sensitiveform || !$pigmentedform || !$wrinkledform) { ?>

            <a class="btn btn-outline-custom btn-lg px-3 py-3 rounded-3 shadow-sm">
              ابتدا هر چهار ارزیابی را تکمیل کنید
            </a>

          <?php } else { ?>

            <a href="medicalprescription.php" class="btn btn-outline-custom btn-lg px-3 py-3 rounded-3 shadow-sm">
              نسخه تایپ پوستی شما
            </a>

          <?php } ?>

          <small>پس از تکمیل هر چهار ارزیابی، تحلیل نتایج و نسخه شخصی‌سازی شده آماده خواهد شد.</small>
        </div>
      </section>

      <section class="doctor-card">
        <div class="doctor-photo"><img src="./assets/images/landing1.jpg" alt="دکتر شهره دلاور"></div>
        <div><small>تحت نظر</small>
          <h3>دکتر شهره دادور</h3>
        </div>
        <p>پوست هر فرد ویژگی‌های خاص خود را دارد؛ به همین دلیل، یک روتین مراقبتی باید متناسب با شرایط پوستی شما طراحی شود. در پوستتو بشناس تلاش می‌کنیم با تکیه بر جدیدترین پژوهش‌ها و استانداردهای روز دنیا برای ارائه تحلیلی دقیق و روتین اختصاصی استفاده می‌کنیم.</p>
      </section>
    </main>
  </div>
  <script>
    (function() {
      var toggle = document.getElementById('sidebarToggle');
      var sidebar = document.getElementById('sidebar');
      var overlay = document.getElementById('sidebarOverlay');
      if (!toggle || !sidebar || !overlay) return;

      function setOpen(open) {
        document.body.classList.toggle('sidebar-open', open);
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        toggle.setAttribute('aria-label', open ? 'بستن منو' : 'باز کردن منو');
        overlay.hidden = !open;
      }

      toggle.addEventListener('click', function() {
        setOpen(!document.body.classList.contains('sidebar-open'));
      });

      overlay.addEventListener('click', function() {
        setOpen(false);
      });

      sidebar.querySelectorAll('a').forEach(function(link) {
        link.addEventListener('click', function() {
          if (window.matchMedia('(max-width: 768px)').matches) setOpen(false);
        });
      });

      window.addEventListener('resize', function() {
        if (!window.matchMedia('(max-width: 768px)').matches) setOpen(false);
      });
    })();
  </script>
</body>

</html>