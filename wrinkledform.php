<?php
require_once 'config.php';
is_login();

if (isset($_POST["submit"])) {
    $q1 = $_POST["q1"];
    $q2 = $_POST["q2"];
    $q3 = $_POST["q3"];
    $q4 = $_POST["q4"];
    $q5 = $_POST["q5"];
    $q6 = $_POST["q6"];
    $q7 = $_POST["q7"];
    $q8 = $_POST["q8"];
    $q9 = $_POST["q9"];
    $q10 = $_POST["q10"];
    $q11 = $_POST["q11"];
    $q12 = $_POST["q12"];
    $q13 = $_POST["q13"];
    $q14 = $_POST["q14"];
    $q15 = $_POST["q15"];
    $q16 = $_POST["q16"];
    $q17 = $_POST["q17"];
    $q18 = $_POST["q18"];
    $q19 = $_POST["q19"];
    $q20 = $_POST["q20"];
    $q21 = $_POST["q21"];

    $res = 0;

    for ($i = 1; $i <= 21; $i++) {

        $value = (int)$_POST["q$i"];

        if ($i != 21 && $value == 5) {
            $res += 2.5;
        } else {
            $res += $value;
        }
    }

    $description = "";
    if ($res >= 20 && $res <= 40) {
        $description = "نوع پوست شما سفت است.";
    } elseif ($res >= 41 && $res <= 85) {
        $description = "نوع پوست شما چروکیده است.";
    }


    $type = ($res >= 40) ? "W" : "T";

    $insert = $pdo->prepare("INSERT INTO wrinkledform set q1=?, q2=?, q3=?, q4=?, q5=?, q6=?, q7=?, q8=?, q9=?, q10=?, q11=?, q12=?, q13=?, q14=?, q15=?, q16=?, q17=?, q18=?, q19=?, q20=?, q21=?, res=?, type=?, user_id=?");
    $insert->bindValue(1, $q1);
    $insert->bindValue(2, $q2);
    $insert->bindValue(3, $q3);
    $insert->bindValue(4, $q4);
    $insert->bindValue(5, $q5);
    $insert->bindValue(6, $q6);
    $insert->bindValue(7, $q7);
    $insert->bindValue(8, $q8);
    $insert->bindValue(9, $q9);
    $insert->bindValue(10, $q10);
    $insert->bindValue(11, $q11);
    $insert->bindValue(12, $q12);
    $insert->bindValue(13, $q13);
    $insert->bindValue(14, $q14);
    $insert->bindValue(15, $q15);
    $insert->bindValue(16, $q16);
    $insert->bindValue(17, $q17);
    $insert->bindValue(18, $q18);
    $insert->bindValue(19, $q19);
    $insert->bindValue(20, $q20);
    $insert->bindValue(21, $q21);
    $insert->bindValue(22, $res);
    $insert->bindValue(23, $type);
    $insert->bindValue(24, $_SESSION["user_id"]);
    $insert->execute();

    header("Location: resultwrinkledform.php");
};
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تست نوع پوست</title>

    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="assets/style.css">

</head>

<body>

    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-lg-8 card bg-header">

                <div class="text-center mb-5 text-white">
                    <h1 class="fw-bold">تست نوع پوست</h1>
                    <p class="text-white">
                        چروکیده در مقابل سفت
                    </p>
                </div>

                <form method="post">

                    <div>
                        <!-- سوال 1 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    آیا چین و چروک روی صورتتان دارید؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q1" value="1" required>
                                    خیر، حتی هنگام حرکت مثل لبخند زدن، اخم کردن یا بالا بردن ابرو
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q1" value="2">
                                    فقط هنگام حرکت مثل لبخند زدن، اخم کردن یا بالا بردن ابرو
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q1" value="3">
                                    بله، هنگام حرکت و چند چین در حالت استراحت بدون حرکت
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q1" value="4">
                                    چین‌ها حتی وقتی لبخند نمی‌زنم، اخم نمی‌کنم یا ابرو بالا نمی‌برم، وجود دارند
                                </label>
                            </div>

                            <div class="alert alert-warning py-2">
                                <span>سوال‌های ۲ تا ۷ را با مقایسه خود و اعضای خانواده با دیگر گروه‌های قومی پاسخ دهید، نه فقط گروه خودتان. برای اعضای خانواده‌ای که نمی‌شناسید، از دیگر اعضا یا عکس‌ها کمک بگیرید.</span>
                            </div>
                        </div>

                        <!-- سوال 2 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    پوست صورت مادرتان چند ساله به نظر می‌رسد؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q2" value="1" required>
                                    ۵ تا ۱۰ سال جوان‌تر از سن واقعی
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q2" value="2">
                                    سن واقعی
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q2" value="3">
                                    ۵ سال مسن‌تر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q2" value="4">
                                    بیش از ۵ سال مسن‌تر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q2" value="5">
                                    غیرقابل اعمال: من فرزند خوانده هستم یا یادم نمی‌آید
                                </label>

                            </div>
                        </div>

                        <!-- سوال 3 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    پوست صورت پدرتان چند ساله به نظر می‌رسد؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="1" required>
                                    ۵ تا ۱۰ سال جوان‌تر از سن واقعی
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="2">
                                    سن واقعی
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="3">
                                    ۵ سال مسن‌تر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="4">
                                    بیش از ۵ سال مسن‌تر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="5">
                                    غیرقابل اعمال: من فرزند خوانده هستم یا یادم نمی‌آید
                                </label>

                            </div>
                        </div>

                        <!-- سوال 4 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    پوست صورت مادربزرگ مادریتان چند ساله به نظر می‌رسد؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="1" required>
                                    ۵ تا ۱۰ سال جوان‌تر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="2">
                                    سن واقعی
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="3">
                                    ۵ سال مسن‌تر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="4">
                                    بیش از ۵ سال مسن‌تر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="5">
                                    غیرقابل اعمال: فرزندخوانده هستم، او را نمی‌شناختم یا یادم نمی‌آید
                                </label>

                            </div>
                        </div>

                        <!-- سوال 5 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    پوست صورت پدربزرگ مادریتان چند ساله به نظر می‌رسد؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="1" required>
                                    ۵ تا ۱۰ سال جوان‌تر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="2">
                                    سن واقعی
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="3">
                                    ۵ سال مسن‌تر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="4">
                                    بیش از ۵ سال مسن‌تر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="5">
                                    غیرقابل اعمال: فرزندخوانده هستم، او را نمی‌شناختم یا یادم نمی‌آید
                                </label>
                            </div>
                        </div>

                        <!-- سوال 6 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    پوست صورت مادربزرگ پدریتان چند ساله به نظر می‌رسد؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q6" value="1" required>
                                    ۵ تا ۱۰ سال جوان‌تر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q6" value="2">
                                    سن واقعی
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q6" value="3">
                                    ۵ سال مسن‌تر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q6" value="4">
                                    بیش از ۵ سال مسن‌تر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q6" value="5">
                                    غیرقابل اعمال: فرزندخوانده هستم، او را نمی‌شناختم یا یادم نمی‌آید
                                </label>

                            </div>
                        </div>

                        <!-- سوال 7 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    پوست صورت پدربزرگ پدریتان چند ساله به نظر می‌رسد؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q7" value="1" required>
                                    ۵ تا ۱۰ سال جوان‌تر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q7" value="2">
                                    سن واقعی
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q7" value="3">
                                    ۵ سال مسن‌تر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q7" value="4">
                                    بیش از ۵ سال مسن‌تر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q7" value="5">
                                    غیرقابل اعمال: فرزندخوانده هستم، او را نمی‌شناختم یا یادم نمی‌آید
                                </label>

                            </div>

                            <div class="alert alert-warning py-2">
                                <span>اگر دلیلش این است که پوستتان را خشک می‌کنند، گزینه «احساس خشکی دارد یا ترک می‌خورد» را انتخاب کنید.</span>
                            </div>
                        </div>

                        <!-- سوال 8 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    آیا در طول زندگی خود، بیش از دو هفته در سال به طور مداوم پوست خود را برنزه کرده‌اید؟ اگر بله، مجموع چند سال این کار را انجام داده‌اید؟ (ورزش‌های خارج از خانه مانند تنیس، ماهیگیری، گلف، اسکی و غیره را در نظر بگیرید. فقط ساحل محل برنزه شدن نیست.)
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q8" value="1" required>
                                    هرگز
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q8" value="2">
                                    ۱ تا ۵ سال
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q8" value="3">
                                    ۵ تا ۱۰ سال
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q8" value="4">
                                    بیش از ۱۰ سال
                                </label>

                            </div>

                        </div>

                        <!-- سوال 9 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    آیا در طول زندگی خود، برنزه فصلی (دو هفته یا کمتر در سال) داشته‌اید؟ (بله، تعطیلات تابستانی حساب می‌شود!) اگر بله، چند سال؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q9" value="1" required>
                                    هرگز
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q9" value="2">
                                    ۱ تا ۵ سال
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q9" value="3">
                                    ۵ تا ۱۰ سال
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q9" value="4">
                                    بیش از ۱۰ سال
                                </label>

                            </div>
                        </div>

                        <!-- سوال 10 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    با توجه به مکان‌هایی که زندگی کرده‌اید، روزانه چه میزان در معرض نور خورشید بوده‌اید؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q10" value="1" required>
                                    کم: بیشتر در مناطق ابری و خاکستری زندگی کرده‌ام
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q10" value="2">
                                    مقداری: گاهی در مناطق کم‌آفتاب و گاهی در مناطق پرنور
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q10" value="3">
                                    متوسط: در مناطقی با میزان قابل توجهی نور آفتاب زندگی کرده‌ام
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q10" value="4">
                                    زیاد: در مناطق استوایی، شمالی یا بسیار آفتابی زندگی کرده‌ام
                                </label>
                            </div>
                        </div>

                        <!-- سوال 11 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    به نظر خودتان چند ساله به نظر می‌رسید؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q11" value="1" required>
                                    ۱ تا ۵ سال جوان‌تر از سن واقعی
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q11" value="2">
                                    سن واقعی
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q11" value="3">
                                    ۵ سال مسن‌تر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q11" value="4">
                                    بیش از ۵ سال مسن‌تر
                                </label>

                            </div>
                        </div>

                        <!-- سوال 12 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    طی پنج سال گذشته، چند بار اجازه داده‌اید پوستتان به طور عمدی یا غیرعمدی برنزه شود؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q12" value="1" required>
                                    هرگز
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q12" value="2">
                                    یک بار در ماه
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q12" value="3">
                                    یک بار در هفته
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q12" value="4">
                                    روزانه
                                </label>

                            </div>
                        </div>

                        <!-- سوال 13 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    چند بار از تخت برنزه استفاده کرده‌اید؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q13" value="1" required>
                                    هرگز
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q13" value="2">
                                    ۱ تا ۵ بار
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q13" value="3">
                                    ۵ تا ۱۰ بار
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q13" value="4">
                                    بارهای زیادی
                                </label>
                            </div>
                        </div>

                        <!-- سوال 14 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    در طول عمرتان، چند سیگار کشیده‌اید یا در معرض دود آن بوده‌اید؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q14" value="1" required>
                                    هیچ‌کدام
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q14" value="2">
                                    چند بسته
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q14" value="3">
                                    چندین بسته
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q14" value="4">
                                    روزانه می‌کشم
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q14" value="5">
                                    هرگز سیگار نکشیده‌ام اما با کسانی که سیگار می‌کشیدند زندگی کرده‌ام، بزرگ شده‌ام یا کار کرده‌ام
                                </label>
                            </div>
                        </div>

                        <!-- سوال 15 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    آلودگی هوایی محل زندگی شما چگونه است؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q15" value="1" required>
                                    هوا تازه و تمیز است
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q15" value="2">
                                    بخشی از سال، اما نه تمام سال، در مکانی با هوای تمیز زندگی کرده‌ام
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q15" value="3">
                                    هوا کمی آلوده است
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q15" value="4">
                                    هوا بسیار آلوده است
                                </label>
                            </div>
                        </div>

                        <!-- سوال 16 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    طول مدت استفاده از کرم‌های رتینوئید صورت مانند رتینول، رنووا، رتین-آ، تازوراک، دیفرین یا اوویج چقدر بوده است؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q16" value="1" required>
                                    سال‌های زیادی
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q16" value="2">
                                    گاهی اوقات
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q16" value="3">
                                    یک بار برای آکنه در جوانی
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q16" value="4">
                                    هرگز
                                </label>

                            </div>
                        </div>

                        <!-- سوال 17 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    در حال حاضر چند بار میوه و سبزیجات می‌خورید؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q17" value="1" required>
                                    در هر وعده غذایی
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q17" value="2">
                                    روزی یک بار
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q17" value="3">
                                    گاهی اوقات
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q17" value="4">
                                    هرگز
                                </label>
                            </div>
                        </div>

                        <!-- سوال 18 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    در طول زندگی، چه درصدی از رژیم روزانه شما شامل میوه و سبزیجات بوده است؟ (آب میوه‌ها را به جز آب تازه‌گیری شده حساب نکنید)
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q18" value="1" required>
                                    ۷۵ تا ۱۰۰٪
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q18" value="2">
                                    ۲۵ تا ۷۵٪
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q18" value="3">
                                    ۱۰ تا ۲۵٪
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q18" value="4">
                                    ۰ تا ۲۵٪
                                </label>
                            </div>
                        </div>

                        <!-- سوال 19 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    رنگ طبیعی پوست شما (بدون برنزه یا برنزه‌کننده) چیست؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q19" value="1" required>
                                    تیره
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q19" value="2">
                                    متوسط
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q19" value="3">
                                    روشن
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q19" value="4">
                                    خیلی روشن
                                </label>
                            </div>
                        </div>

                        <!-- سوال 20 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    قومیت شما چیست؟ (بهترین گزینه را انتخاب کنید)
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q20" value="1" required>
                                    آفریقایی-آمریکایی / کارائیبی / سیاه
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q20" value="2">
                                    آسیایی / هندی / مدیترانه‌ای / دیگر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q20" value="3">
                                    لاتین-آمریکایی / اسپانیایی
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q20" value="4">
                                    قفقازی
                                </label>
                            </div>
                        </div>


                        <!-- سوال 21 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    بالای ۶۵ سال دارید؟
                                </h4>
                                <label class="answer-item d-block">
                                    <input type="radio" name="q21" value="0" required>
                                    خیر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q21" value="5">
                                    بله
                                </label>
                            </div>

                        </div>

                        <div class="d-grid">
                            <button type="submit" class="submit-btn" name="submit">
                                مشاهده نتیجه
                            </button>
                        </div>

                </form>

            </div>
        </div>

    </div>

</body>

</html>