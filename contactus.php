<!doctype html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>پوستو بشناس | تماس با ما</title>
  <link rel="stylesheet" href="./assets/css/bootstrap.rtl.min.css">
  <link rel="stylesheet" href="./assets/style.css">
</head>

<body>
<?php include 'header.php';?>
  <main>
    <section class="hero">
      <div class="container-fluid px-3 px-md-4 px-lg-5">
        <div class="row align-items-center flex-nowrap">
          <div class="col-6 hero-copy">
            <h1 class="fw-bolder">تماس با ما</h1>
            <h2 class="fw-bold">در ارتباط با شما هستیم.</h2>
            <span class="accent-line"></span>
            <p>
              اگر درباره ارزیابی نوع پوست، روتین‌های مراقبتی، همکاری‌های علمی
              یا همکاری با برندها سوالی دارید، از طریق راه‌های ارتباطی زیر با ما
              در تماس باشید.
            </p>
          </div>

          <div class="col-6 hero-art text-center">
            <div class="portrait-wrap">
              <img src="./assets/images/landing2.jpg"
                alt="مراقبت پوست"
                class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="contact-area">
      <div class="container-fluid px-3 px-md-4 px-lg-5">
        <div class="row g-4">
          <div class="col-lg-5">
            <article class="doctor-card">

              <div class="doctor-photo-con">
                <img src="./assets/images/landing1.jpg" alt="دکتر شهره دلاور">
              </div>
              <div>
                <h3 class="fw-bolder">دکتر شهره دلاور</h3>
                <p class="fw-semibold">پزشک عمومی<br>پژوهشگر حوزه پوست<br>طراح و مسئول علمی سامانه پوستو بشناس</p>
              </div>
            </article>
            <div class="info-list">
              <article>
                <span class="icon">
                  <?= file_get_contents('assets/icons/envelope.svg'); ?>
                </span>
                <div>
                  <h4 class="fw-bold">ایمیل</h4>
                  <p class="fw-semibold">shohreh.delavar@gmail.com</p>
                </div>
              </article>
              <article>
                <span class="icon">
                  <?= file_get_contents('assets/icons/instagram.svg'); ?>
                </span>
                <div>
                  <h4 class="fw-bold">اینستاگرام</h4>
                  <p class="fw-semibold">@dr.shohredelavar</p>
                </div>
              </article>
              <article>
                <span class="icon">
                  <?= file_get_contents('assets/icons/clock.svg'); ?>
                </span>
                <div>
                  <h4 class="fw-bold">ساعات پاسخگویی</h4>
                  <p class="fw-semibold">شنبه تا چهارشنبه: ۹ الی ۱۸<br>پنجشنبه: ۹ الی ۱۳</p>
                </div>
              </article>
            </div>
          </div>
          <div class="col-lg-7">
            <article class="ways-card">
              <h2 class="fw-bolder fs-4">زمینه‌های ارتباط</h2><span class="accent-line"></span>
              <div class="way">
                <span class="icon">
                  <?= file_get_contents('assets/icons/headset.svg'); ?>
                </span>
                <div>
                  <h3 class="fw-bold fs-5">پشتیبانی کاربران سایت</h3>
                  <p class="fw-medium">پاسخ به سوالات شما درباره استفاده از سامانه و دریافت نتایج ارزیابی</p>
                </div>
              </div>
              <div class="way">
                <span class="icon">
                  <?= file_get_contents('assets/icons/cart-check.svg'); ?>
                </span>
                <div>
                  <h3 class="fw-bold fs-5">همکاری با برندهای مراقبت پوست و مو</h3>
                  <p class="fw-medium">همکاری در زمینه معرفی محصولات، کمپین‌ها و پروژه‌های مشترک</p>
                </div>
              </div>
              <div class="way">
                <span class="icon">
                  <?= file_get_contents('assets/icons/flask-florence.svg'); ?>
                </span>
                <div>
                  <h3 class="fw-bold fs-5">همکاری پژوهشی</h3>
                  <p class="fw-medium">همکاری در مطالعات، پایان‌نامه‌ها و پروژه‌های تحقیقاتی</p>
                </div>
              </div>
              <div class="way">
                <span class="icon">
                  <?= file_get_contents('assets/icons/chat-dots.svg'); ?>
                </span>
                <div>
                  <h3 class="fw-bold fs-5">پیشنهادات و انتقادات</h3>
                  <p class="fw-medium">شنیدن نظرات شما برای بهبود خدمات پوستو بشناس</p>
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>

    <section class="message-section">
      <div class="container-fluid px-3 px-md-4 px-lg-5">
        <div class="message-box">
          <div class="message-illustration d-none d-md-flex"><i class="ri-message-3-line"></i></div>
          <form>
            <h2 class="fw-bolder fs-4">پیام خود را برای ما ارسال کنید.</h2>
            <div class="form-row"><input type="text" placeholder="نام و نام خانوادگی"><input type="email" placeholder="ایمیل"><input type="text" placeholder="موضوع"></div><textarea placeholder="پیام شما..."></textarea><button type="button"><i class="ri-send-plane-line"></i> ارسال پیام</button>
          </form>
        </div>
      </div>
    </section>
  </main>
<?php include 'footer.php'; ?>
  <script src="./assets/css/bootstrap.bundle.min.js"></script>


</body>

</html>