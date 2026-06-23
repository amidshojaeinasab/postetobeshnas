<?php
require_once 'config.php';

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

 $res=0;
    for($i=1;$i<=11;$i++){
        if($_POST["q$i"] == 5){
            $res +=2.5; 
        }
        else{
            $res+=$_POST["q$i"];
        }
    }

$description = "";
if ($res >= 13 && $res <= 28) {
    $description = "نوع پوست شما رنگدانه دار است.";
} elseif ($res >= 29 && $res <= 52) {
    $description = "نوع پوست شما غیر رنگدانه دار است.";}




$type = ($res >= 29) ? "P" : "N";

    $insert = $pdo-> prepare("INSERT INTO pigmentedform set q1=?, q2=?, q3=?, q4=?, q5=?, q6=?, q7=?, q8=?, q9=?, q10=?, q11=?, q12=?, q13=?, res=?, type=?, user_id=?");
    $insert->bindValue(1,$q1);
    $insert->bindValue(2,$q2);
    $insert->bindValue(3,$q3);
    $insert->bindValue(4,$q4);
    $insert->bindValue(5,$q5);
    $insert->bindValue(6,$q6);
    $insert->bindValue(7,$q7);
    $insert->bindValue(8,$q8);
    $insert->bindValue(9,$q9);
    $insert->bindValue(10,$q10);
    $insert->bindValue(11,$q11);
    $insert->bindValue(12,$q12);
    $insert->bindValue(13,$q13);
    $insert->bindValue(14,$res);
    $insert->bindValue(15,$type);
    $insert->bindValue(16,$_SESSION["user_id"]);
    $insert->execute();
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
                       پوست رنگ دانه دار در مقابل غیر رنگدانه دار
                    </p>
                </div>

                <form method="post">

                    <div>
                        <!-- سوال 1 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    بعد از داشتن جوش یا مو زیرپوستی، آیا روی پوستتان لکه‌ای قهوه‌ای تیره یا سیاه ظاهر می‌شود؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q1" value="1" required>
                                    هرگز
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q1" value="2">
                                    گاهی اوقات
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q1" value="3">
                                    اغلب
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q1" value="4">
                                    همیشه
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q1" value="5">
                                    من هرگز جوش یا مو زیرپوستی ندارم
                                </label>

                            </div>
                        </div>

                        <!-- سوال 2 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    بعد از بریدگی پوست، لکه قهوه‌ای (نه صورتی) چه مدت باقی می‌ماند؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q2" value="1" required>
                                    من لکه قهوه‌ای ایجاد نمی‌کنم
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q2" value="2">
                                    یک هفته
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q2" value="3">
                                    چند هفته
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q2" value="4">
                                    ماه‌ها
                                </label>

                            </div>
                        </div>

                        <!-- سوال 3 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    هنگام بارداری، مصرف قرص‌های ضدبارداری یا هورمون درمانی (HRT)، چند لکه تیره روی صورت ایجاد شد؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="1" required>
                                    هیچ‌کدام
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="2">
                                    یکی
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="3">
                                    چند تا
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="4">
                                    تعداد زیادی
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="5">
                                    این سؤال برای من صدق نمی‌کند (چون مرد هستم، یا هرگز باردار نشده‌ام، یا قرص ضدبارداری یا HRT استفاده نکرده‌ام، یا مطمئن نیستم که لکه تیره داشته‌ام)
                                </label>

                            </div>
                        </div>

                        <!-- سوال 4 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    آیا روی لب بالایی یا گونه‌ها لکه یا ناحیه تیره دارید؟ یا قبلاً داشته‌اید که برداشته شده باشد؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="1" required>
                                    خیر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="2">
                                    مطمئن نیستم
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="3">
                                    بله، کمی قابل مشاهده است (یا بوده است)
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="4">
                                    بله، بسیار قابل مشاهده است (یا بوده است)
                                </label>

                            </div>
                        </div>

                        <!-- سوال 5 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    آیا لکه‌های تیره صورت شما هنگام آفتاب گرفتن بدتر می‌شوند؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="1" required>
                                    من لکه تیره ندارم
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="2">
                                    مطمئن نیستم
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="3">
                                    کمی بدتر می‌شوند
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="4">
                                    خیلی بدتر می‌شوند
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="5">
                                    من هر روز ضدآفتاب استفاده می‌کنم و هرگز آفتاب نمی‌گیرم
                                </label>
                            </div>
                            <div class="alert alert-warning py-2">
                                <span>توجه: اگر از محافظت مداوم در برابر آفتاب استفاده می‌کنید چون می‌ترسید لکه یا کک‌ومک ایجاد شود، گزینه آخر را انتخاب کنید.</span>
                            </div>
                        </div>

                        <!-- سوال 6 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    آیا تاکنون برای شما ملاسما، لکه‌های قهوه‌ای روشن، تیره یا خاکستری روی صورت، تشخیص داده شده است؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q6" value="1" required>
                                    خیر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q6" value="2">
                                    یک بار، ولی برطرف شد
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
                                    آیا تاکنون لکه‌های قهوه‌ای کوچک (کک‌ومک یا لکه‌های خورشیدی) روی صورت، سینه، پشت یا بازوهایتان داشته‌اید؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q7" value="1" required>
                                    خیر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q7" value="2">
                                    بله، چند عدد (۱ تا ۵)
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q7" value="3">
                                    بله، تعداد زیادی (۶ تا ۱۵)
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q7" value="4">
                                    بله، خیلی زیاد (۱۶ یا بیشتر)
                                </label>

                            </div>
                        </div>

                        <!-- سوال 8 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    وقتی برای اولین بار بعد از چند ماه در معرض آفتاب قرار می‌گیرید، پوستتان چه واکنشی دارد؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q8" value="1" required>
                                    فقط می‌سوزد
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q8" value="2">
                                    می‌سوزد و سپس تیره‌تر می‌شود
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q8" value="3">
                                    تیره‌تر می‌شود
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q8" value="4">
                                    پوست من قبلاً تیره است، پس تشخیص تیره‌تر شدن سخت است
                                </label>
                            </div>
                            <div class="alert alert-warning py-2">
                                <span>توجه: گزینه «هرگز در معرض آفتاب نبوده‌ام» قابل انتخاب نیست. تجربه‌های کودکی را در نظر بگیرید.</span>
                            </div>
                        </div>

                        <!-- سوال 9 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    بعد از چند روز متوالی قرار گرفتن در آفتاب، چه اتفاقی می‌افتد؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q9" value="1" required>
                                    من آفتاب‌سوخته و تاول می‌زنم، ولی رنگ پوست تغییر نمی‌کند
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q9" value="2">
                                    پوست من کمی تیره‌تر می‌شود
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q9" value="3">
                                    پوست من خیلی تیره‌تر می‌شود
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q9" value="4">
                                    پوست من قبلاً تیره است، پس تشخیص تیره‌تر شدن سخت است
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q9" value="5">
                                    مطمئن نیستم
                                </label>
                            </div>

                            <div class="alert alert-warning py-2">
                                <span>گزینه «هرگز در معرض آفتاب نبوده‌ام» قابل انتخاب نیست. تجربه‌های کودکی را در نظر بگیرید.</span>
                            </div>
                        </div>

                        <!-- سوال 10 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    وقتی زیر آفتاب می‌روید، آیا کک‌ومک (لکه‌های کوچک ۱-۲ میلی‌متری) ایجاد می‌کنید؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q10" value="1" required>
                                    خیر، هیچ‌وقت ایجاد نمی‌کنم
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q10" value="2">
                                    سالانه چند کک‌ومک کوچک جدید ایجاد می‌کنم
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q10" value="3">
                                    اغلب کک‌ومک‌های جدید ایجاد می‌کنم
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q10" value="4">
                                    پوست من قبلاً تیره است، پس تشخیص کک‌ومک سخت است
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q10" value="5">
                                    من هرگز زیر آفتاب نمی‌روم
                                </label>
                            </div>
                        </div>

                        <!-- سوال 11 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    آیا والدین شما کک‌ومک داشته‌اند؟ اگر بله، لطفاً تعداد را مشخص کنید. اگر هیچ‌کدام یا فقط یکی داشته، به سؤال پاسخ دهید. اگر هر دو داشته‌اند، به والد با بیشترین کک‌ومک پاسخ دهید.
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q11" value="1" required>
                                    خیر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q11" value="2">
                                    چند عدد روی صورت
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q11" value="3">
                                    تعداد زیادی روی صورت
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q11" value="4">
                                    تعداد زیادی روی صورت، سینه، گردن و شانه‌ها
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q11" value="5">
                                    مطمئن نیستم
                                </label>

                            </div>
                        </div>

                        <!-- سوال 12 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    رنگ طبیعی موهای شما چیست؟ (اگر خاکستری است، رنگ قبل از خاکستری شدن را بگویید)
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q12" value="1" required>
                                    بلوند
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q12" value="2">
                                    قهوه‌ای
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q12" value="3">
                                    مشکی
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q12" value="4">
                                    قرمز
                                </label>

                            </div>
                        </div>

                        <!-- سوال 13 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    آیا شما یا خانواده نزدیکتان سابقه ملانوما داشته‌اید؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q13" value="1" required>
                                    خیر
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q13" value="2">
                                    … (گزینه‌ها بسته به متن اصلی ادامه دارند)
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q13" value="3">
                                    مطمئن نیستم
                                </label>
                            </div>

                            <div class="alert alert-warning py-2">
                                <span>توجه: اگر لکه‌های تیره در مناطق معرض آفتاب دارید، ۵ امتیاز به مجموع امتیازات اضافه کنید.</span>
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