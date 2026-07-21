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

    $res = 0;

    for ($i = 1; $i <= 19; $i++) {

        $value = (int)$_POST["q$i"];

        if ($i != 19 && $value == 5) {
            $res += 2.5;
        } else {
            $res += $value;
        }
    }

    $description = "";
    if ($res >= 34 && $res <= 72) {
        $description = "پوست بسیار حساس دارید.";
    } elseif ($res >= 30 && $res <= 33) {
        $description = "پوست کمی حساس دارید.";
    } elseif ($res >= 25 && $res <= 29) {
        $description = "پوست کمی مقاوم دارید.";
    } elseif ($res >= 17 && $res <= 24) {
        $description = "پوست بسیار مقاوم دارید.";
    }


    $type = ($res >= 30) ? "S" : "R";

    $insert = $pdo->prepare("INSERT INTO sensitiveform set q1=?, q2=?, q3=?, q4=?, q5=?, q6=?, q7=?, q8=?, q9=?, q10=?, q11=?, q12=?, q13=?, q14=?, q15=?, q16=?, q17=?, q18=?, q19=?, res=?, type=?, user_id=?");
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
    $insert->bindValue(20, $res);
    $insert->bindValue(21, $type);
    $insert->bindValue(22, $_SESSION["user_id"]);
    $insert->execute();

    header("Location: resultsensitiveform.php");
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
                        حساس در مقابل مقاوم
                    </p>
                </div>

                <form method="post">

                    <div>
                        <!-- سوال 1 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    روی صورت شما برجستگی‌های قرمز ایجاد می‌شود:
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q1" value="1" required>
                                    هرگز
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q1" value="2">
                                    به ندرت
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q1" value="3">
                                    حداقل یک بار در ماه
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q1" value="4">
                                    حداقل یک بار در هفته
                                </label>

                            </div>
                        </div>

                        <!-- سوال 2 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    محصولات مراقبت از پوست (شامل شوینده، مرطوب‌کننده، تونر و آرایش) باعث بروز جوش، جوش‌ریزی، خارش یا سوزش روی صورت شما می‌شوند:
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q2" value="1" required>
                                    هرگز
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q2" value="2">
                                    به ندرت
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q2" value="3">
                                    اغلب
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q2" value="4">
                                    همیشه
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q2" value="5">
                                    من از محصولات روی صورت استفاده نمی‌کنم
                                </label>

                            </div>
                        </div>

                        <!-- سوال 3 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    آیا تاکنون تشخیص آکنه یا روزاسه روی پوست شما داده شده است؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="1" required>
                                    خیر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="2">
                                    دوستان و آشنایان به من گفته‌اند که دارم
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="3">
                                    بله
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="4">
                                    بله، مورد شدید
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="5">
                                    مطمئن نیستم
                                </label>

                            </div>
                        </div>

                        <!-- سوال 4 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    اگر جواهراتی که کمتر از طلای ۱۴ عیار هستند می‌پوشید، چند وقت یک‌بار دچار جوش یا قرمزی می‌شوید؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="1" required>
                                    هرگز
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="2">
                                    به ندرت
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="3">
                                    اغلب
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="4">
                                    همیشه
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="5">
                                    مطمئن نیستم
                                </label>

                            </div>
                        </div>

                        <!-- سوال 5 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    ضدآفتاب باعث خارش، سوزش، جوش یا قرمزی پوست شما می‌شود:
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="1" required>
                                    هرگز
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="2">
                                    به ندرت
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="3">
                                    اغلب
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="4">
                                    همیشه
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="5">
                                    من هرگز از ضدآفتاب استفاده نمی‌کنم
                                </label>
                            </div>
                        </div>

                        <!-- سوال 6 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    آیا تاکنون برای شما تشخیص درماتیت آتوپیک، اگزما یا درماتیت تماسی (جوش یا قرمزی آلرژیک پوست) داده شده است؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q6" value="1" required>
                                    خیر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q6" value="2">
                                    دوستان به من گفته‌اند که دارم
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q6" value="3">
                                    بله
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q6" value="4">
                                    بله، مورد شدید
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q6" value="5">
                                    مطمئن نیستم
                                </label>

                            </div>
                        </div>

                        <!-- سوال 7 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    چند وقت یک‌بار زیر انگشترهایتان دچار جوش یا قرمزی می‌شوید؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q7" value="1" required>
                                    هرگز
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q7" value="2">
                                    به ندرت
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q7" value="3">
                                    اغلب
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q7" value="4">
                                    همیشه
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q7" value="5">
                                    من انگشتر نمی‌پوشم
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
                                    حمام حباب‌دار معطر، روغن ماساژ یا لوسیون‌های بدن باعث جوش، خارش یا خشکی پوست شما می‌شوند:
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q8" value="1" required>
                                    هرگز
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q8" value="2">
                                    به ندرت
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q8" value="3">
                                    اغلب
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q8" value="4">
                                    همیشه
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q8" value="5">
                                    من هرگز از این محصولات استفاده نمی‌کنم
                                </label>
                            </div>
                            <div class="alert alert-warning py-2">
                                <span>توجه: اگر دلیل عدم استفاده شما این است که باعث مشکلات فوق می‌شوند، گزینه «همیشه» را انتخاب کنید.</span>
                            </div>
                        </div>

                        <!-- سوال 9 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    آیا می‌توانید از صابون‌های هتل‌ها روی بدن یا صورت خود بدون مشکل استفاده کنید؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q9" value="1" required>
                                    بله
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q9" value="2">
                                    اکثر مواقع مشکلی ندارم
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q9" value="3">
                                    خیر، پوست من خارش می‌کند، قرمز می‌شود یا جوش می‌زند
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q9" value="4">
                                    از آن استفاده نمی‌کنم، قبلاً مشکلات زیادی داشته‌ام
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q9" value="5">
                                    من صابون خودم را می‌آورم، بنابراین مطمئن نیستم
                                </label>

                            </div>
                        </div>

                        <!-- سوال 10 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    آیا کسی در خانواده شما به درماتیت آتوپیک، اگزما، آسم یا آلرژی تشخیص داده شده است؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q10" value="1" required>
                                    خیر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q10" value="2">
                                    یک عضو خانواده که من می‌دانم
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q10" value="3">
                                    چند عضو خانواده
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q10" value="4">
                                    بسیاری از اعضای خانواده من دچار درماتیت، اگزما، آسم و/یا آلرژی هستند
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q10" value="5">
                                    نمیدانم
                                </label>
                            </div>
                        </div>

                        <!-- سوال 11 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    اگر از پودر لباسشویی معطر یا ورقه‌های ضد الکتریسیته ساکن در خشک‌کن استفاده کنید، چه اتفاقی برای پوستتان می‌افتد؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q11" value="1" required>
                                    پوست من مشکلی ندارد
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q11" value="2">
                                    پوست من کمی خشک می‌شود
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q11" value="3">
                                    پوست من دچار خارش می‌شود
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q11" value="4">
                                    پوست من خارش دارد و جوش یا قرمزی ایجاد می‌شود
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q11" value="5">
                                    مطمئن نیستم یا هرگز از آن‌ها استفاده نکرده‌ام
                                </label>

                            </div>
                        </div>

                        <!-- سوال 12 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    چند وقت یک‌بار بعد از ورزش متوسط، استرس یا یک احساس قوی مثل عصبانیت، صورت و/یا گردن شما قرمز می‌شود؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q12" value="1" required>
                                    هرگز
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q12" value="2">
                                    گاهی اوقات
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q12" value="3">
                                    اغلب
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q12" value="4">
                                    همیشه
                                </label>

                            </div>
                        </div>

                        <!-- سوال 13 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    چند وقت یک‌بار بعد از نوشیدن الکل، قرمزی و گرگرفتگی صورت پیدا می‌کنید؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q13" value="1" required>
                                    هرگز
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q13" value="2">
                                    گاهی اوقات
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q13" value="3">
                                    اغلب
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q13" value="4">
                                    همیشه، یا به خاطر این مشکل الکل نمی‌نوشم
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q13" value="5">
                                    من هرگز الکل نمی‌نوشم
                                </label>

                            </div>
                        </div>

                        <!-- سوال 14 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    چند وقت یک‌بار بعد از خوردن غذاها یا نوشیدنی‌های تند یا داغ (از نظر دما)، صورت شما قرمز و گرم می‌شود؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q14" value="1" required>
                                    هرگز
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q14" value="2">
                                    گاهی اوقات
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q14" value="3">
                                    اغلب
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q14" value="4">
                                    همیشه
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q14" value="5">
                                    من هرگز غذای تند نمی‌خورم
                                </label>
                            </div>
                            <div class="alert alert-warning py-2">
                                <span>توجه: اگر به دلیل قرمزی صورت غذای تند یا داغ .نمی‌خورید، گزینه «همیشه» را انتخاب کنید.</span>
                            </div>
                        </div>

                        <!-- سوال 15 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    چند رگ خونی قرمز یا آبی قابل مشاهده روی صورت و بینی دارید (یا قبل از درمان داشته‌اید)؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q15" value="1" required>
                                    هیچ‌کدام
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q15" value="2">
                                    چند عدد (۱ تا ۳ عدد در کل صورت، شامل بینی)
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q15" value="3">
                                    مقداری (۴ تا ۶ عدد در کل صورت، شامل بینی)
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q15" value="4">
                                    تعداد زیاد (بیش از ۷ عدد در کل صورت، شامل بینی)
                                </label>
                            </div>
                        </div>

                        <!-- سوال 16 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    صورت شما در عکس‌ها قرمز به نظر می‌رسد:
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q16" value="1" required>
                                    هرگز یا تا به حال متوجه آن نشدم
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q16" value="2">
                                    گاهی اوقات
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q16" value="3">
                                    اغلب
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q16" value="4">
                                    همیشه
                                </label>

                            </div>
                        </div>

                        <!-- سوال 17 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    افراد از شما می‌پرسند که آیا آفتاب‌سوخته‌اید، حتی وقتی که این‌طور نیست:
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q17" value="1" required>
                                    هرگز
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q17" value="2">
                                    گاهی اوقات
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q17" value="3">
                                    اغلب
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q17" value="4">
                                    همیشه
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q17" value="5">
                                    من همیشه آفتاب‌سوخته‌ام (این خیلی بد است!)
                                </label>

                            </div>
                        </div>

                        <!-- سوال 18 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    از آرایش، ضدآفتاب یا محصولات مراقبت از پوست دچار قرمزی، خارش یا تورم می‌شوید:
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q18" value="1" required>
                                    هرگز
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q18" value="2">
                                    گاهی اوقات
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q18" value="3">
                                    اغلب
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q18" value="4">
                                    همیشه
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q18" value="5">
                                    من از این محصولات استفاده نمی‌کنم
                                </label>
                            </div>
                            <div class="alert alert-warning py-2">
                                <span>توجه: اگر دلیل عدم استفاده شما قرمزی، خارش یا تورم است، گزینه «همیشه» را انتخاب کنید.</span>
                            </div>
                        </div>

                        <!-- سوال 19 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    تاکنون توسط یک متخصص پوست، آکنه، روزاسه، درماتیت تماسی یا اگزما برای شما تشخیص داده شده است.
                                </h4>
                                <label class="answer-item d-block">
                                    <input type="radio" name="q19" value="0" required>
                                    هیچ‌کدام
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q19" value="5">
                                    توسط یک متخصص پوست
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q19" value="2">
                                    توسط پزشک دیگر
                                </label>
                            </div>

                        </div>



                       <div class="d-grid mt-4 mb-4">
                            <button type="submit" class="submit-btn" name="submit">
                                مشاهده نتیجه
                            </button>
                        </div>

                        <div class="text-center mt-4 mb-4 submit-btn">

                <a href="dashboard.php"
                        class="text-decoration-none fw-bold text-white">
                        بازگشت
                </a>

                </div>

                </form>

            </div>
        </div>

    </div>

</body>

</html>