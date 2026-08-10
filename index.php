<?php
    require 'config.php';
?>
<!doctype html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>پوستتو بشناس | Skin Intelligence</title>

  <link rel="stylesheet" href="./assets/css/bootstrap.rtl.min.css">
  <link rel="stylesheet" href="./assets/style.css">

</head>
<?php include 'header.php';?>
<main>
  <section class="hero">
    <div class="container-fluid px-3 px-md-4 px-lg-5">
      <div class="row align-items-center">
        <div class="col-12 col-lg-6 hero-copy"><span class="eyebrow">★ اولین سامانه تخصصی ایرانی</span>
          <h1>پوستتو بشناس</h1>
          <h2>اولین سامانه هوشمند ارزیابی و مراقبت<br>از پوست و مو <em>تحت نظر پزشک</em></h2>
          <p>با پاسخ به چهار پرسشنامه تخصصی، تیپ پوستی خود را بشناسید و روتین پوستی شخصی سازی شده متناسب با نیاز پوستتان را دریافت کنید.</p><a class="btn orange-btn" href="#quiz">شروع ارزیابی پوست <i class="bi bi-arrow-left"></i></a><small class="secure"><i class="bi bi-lock"></i> اطلاعات شما کاملاً محرمانه است</small>
        </div>
        <div class="col-12 col-lg-6 hero-art">
          <div class="portrait-wrap"><img src="./assets/images/1 (2).png" alt="مراقبت پوست"></div>
        </div>
      </div>
    </div>
  </section>

  <section class="container-fluid px-3 px-md-4 px-lg-5 feature-wrap">
    <div class="row g-0 feature-card">
      <div class="col-12 col-sm-6 col-lg-3 feature">
        <span class="icon">
          <?= file_get_contents('assets/icons/shield-check.svg'); ?>
        </span>
        <h3>تحت نظر پزشک</h3>
        <p>طراحی سامانه و ارائه روتین پوستب<br>توسط پزشک</p>
      </div>
      <div class="col-12 col-sm-6 col-lg-3 feature">
        <span class="icon">
          <?= file_get_contents('assets/icons/flask-florence.svg'); ?>
        </span>
        <h3>ارزیابی علمی و جامع پوست</h3>
        <p>بر پایه جدیدترین<br>پژوهش‌های روز دنیا</p>
      </div>
      <div class="col-12 col-sm-6 col-lg-3 feature">
        <span class="icon">
          <?= file_get_contents('assets/icons/crosshair.svg'); ?>
        </span>
        <h3>روتین پوستی شخصی سازی شده</h3>
        <p>نسخه اختصاصی برای نیازهای<br>منحصر به فرد پوست شما</p>
      </div>
      <div class="col-12 col-sm-6 col-lg-3 feature">
        <span class="icon">
          <?= file_get_contents('assets/icons/leaf.svg'); ?>
        </span>
        <h3>محصولات ایرانی و بین‌المللی</h3>
        <p>ارائه دو روتین پوستی مجزا با<br>محصولات ایرانی و برندهای بین المللی</p>
      </div>
    </div>
  </section>

  <section class="container-fluid px-3 px-md-4 px-lg-5 cards-section" id="services">
    <div class="row g-5">

      <div class="col-12 col-md-6 col-lg-4">
        <article class="service-card products">

          <div class="content">
            <span class="icon">
              <?= file_get_contents('assets/icons/chat-square-text.svg'); ?>
            </span>

            <h2>دریافت نسخه اختصاصی</h2>

            <p>
              روتین پوستی فقط مجموعه ای از محصولات مراقبتی نیست، بلکه برنامه ای هدفمند برای حفظ سلامت و عملکرد طبیعی پوست است. یک روتین مناسب می تواند به مدیریت مشکلانی مانند آکنه، خشکی، حساسیت، لک، التهاب و علائم اولیه پیری کمک کند. هدف از یک روتین پوستی صحیح، کمک به حفظ پوستی سلالم، شفاف و جوان است.
            </p>
          </div>

          <div class="products-image">
            <img src="./assets/images/1 (3).png" alt="محصولات پوستی">
          </div>

          <a href="#">
            مشاهده نمونه نسخه‌ها
            <i class="bi bi-arrow-left"></i>
          </a>

        </article>
      </div>

      <div class="col-12 col-md-6 col-lg-4">
        <article class="service-card quiz">

          <div class="content">

            <span class="icon">
              <?= file_get_contents('assets/icons/person-bounding-box.svg'); ?>
            </span>

            <h2>ارزیابی نوع پوست</h2>

            <p>
              با تکمیل چهار ارزیابی تخصصی، تیپ پوستی خود را بشناسید و نسخه اختصاصی دریافت کنید.
            </p>

            <ul>
              <li>چربی پوست</li>
              <li>حساسیت پوست</li>
              <li>لک و تیرگی</li>
              <li>روند پیری و چروک</li>
            </ul>

          </div>

          <a class="navy-btn" href="#">
            شروع ارزیابی پوست
            <i class="bi bi-arrow-left"></i>
          </a>

        </article>
      </div>

      <div class="col-12 col-md-6 col-lg-4">
        <article class="service-card hair-card">

          <div class="hair-content">

            <span class="icon">
              <?= file_get_contents('assets/icons/droplet-half.svg'); ?>
            </span>

            <h2>مراقبت از مو</h2>

            <p>
              به‌زودی سامانه ارزیابی و مراقبت از مو در دسترس شما خواهد بود.
            </p>

            <span class="coming-soon">به‌زودی</span>

          </div>

          <div class="hair-image">
            <img src="./assets/images/1 (1).png" alt="موی سالم">
          </div>

        </article>
      </div>

    </div>
  </section>

  <section class="container-fluid px-3 px-md-4 px-lg-5 doctor" id="doctor">

    <div class="doctor-info">
      <p>
        <span class="icon">
          <?= file_get_contents('assets/icons/person-check.svg'); ?>
        </span>
        پزشک عمومی
      </p>
      <p>
        <span class="icon">
          <?= file_get_contents('assets/icons/book-half.svg'); ?>
        </span>
		پژوهشگر تحقیقات پوست و جذام دانشگاه تهران
      </p>
      <p>
        <span class="icon">
          <?= file_get_contents('assets/icons/file-richtext-fill.svg'); ?>
        </span>
        طراح و مسئول علمی سامانه پوستتو بشناس
      </p>
    </div>

    <div class="doctor-text">
      <h2>دکتر شهره دلاور</h2>
      <h6>پزشک عمومی و پژوهشگر حوزه پوست</h6>

      <p>
        با پشتوانه سال‌ها مطالعه و پژوهش در حوزه مراقبت پوستی و تجربه بالینی،
        سامانه پوستتو بشناس را با هدف کمک به انتخاب روتین صحیح مراقبت از پوست
        و انتخاب آگاهانه محصولات مراقبتی طراحی کرده‌ام.
      </p>
    </div>

    <div class="doctor-photo"><img src="./assets/images/landing1.jpg" alt="دکتر شهره دلاور"></div>


  </section>
</main>



<?php include 'footer.php'; ?>
<script src="./assets/css/bootstrap.bundle.min.js"></script>
</body>

</html>