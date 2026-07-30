<?php
require_once 'config.php';
is_login();

$user_id = $_SESSION['user_id'];

$filled = false;

$stmt = $pdo->prepare("SELECT id FROM oilyform WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);

if ($stmt->fetch()) {
    $filled = true;
}

$stmt = $pdo->prepare("SELECT is_paid FROM users WHERE id=?");
$stmt->execute([$_SESSION['user_id']]);

$user = $stmt->fetch();

if ($user['is_paid'] != 1) {
    header("Location: payment.php");
    exit;
}

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

    $res = 0;
    for ($i = 1; $i <= 11; $i++) {
        if ($_POST["q$i"] == 5) {
            $res += 2.5;
        } else {
            $res += $_POST["q$i"];
        }
    }

    $description = "";
    if ($res >= 34 && $res <= 44) {
        $description = "پوست شما بسیار چرب است.";
    } elseif ($res >= 27 && $res <= 33) {
        $description = "پوست شما کمی چرب است.";
    } elseif ($res >= 17 && $res <= 26) {
        $description = "پوست شما کمی خشک است.";
    } elseif ($res >= 11 && $res <= 16) {
        $description = "پوست شما خشک است.";
    }


    $type = ($res >= 27) ? "O" : "D";

    $insert = $pdo->prepare("INSERT INTO oilyform set q1=?, q2=?, q3=?, q4=?, q5=?, q6=?, q7=?, q8=?, q9=?, q10=?, q11=?, res=?, type=?, user_id=?");
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
    $insert->bindValue(12, $res);
    $insert->bindValue(13, $type);
    $insert->bindValue(14, $_SESSION["user_id"]);
    $insert->execute();

    header("Location: resultOilyform.php");
    exit();
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


<?php if ($filled): ?>

<div class="alert-box">
    <h3>⚠️ این پرسشنامه قبلاً تکمیل شده است.</h3>
    <p>هر کاربر فقط یک بار مجاز به تکمیل این پرسشنامه است.</p>
    <a href='dashboard.php'>
                بازگشت به پنل
            </a>
</div>

<?php else: ?>

<body>

    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-lg-8 card bg-header">

                <div class="text-center mb-5 text-white">
                    <h1 class="fw-bold">تست نوع پوست</h1>
                    <p class="text-white">
                        چرب/خشک
                    </p>
                </div>

                <form method="post">
                    <div>
                        <!-- سوال 1 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    بعد از شستن صورت، هیچ‌گونه مرطوب‌کننده، ضدآفتاب، تونر، پودر یا محصول دیگری استفاده نکنید. دو تا سه ساعت بعد، زیر نور زیاد به صورتتان در آینه نگاه کنید. پیشانی و گونه‌های شما چه احساسی دارند یا چه ظاهری دارند؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q1" value="1" required>
                                    خیلی زبر، پوسته‌پوسته یا خاکستری به نظر می‌رسند
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q1" value="2">
                                    احساس کشیدگی دارند
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q1" value="3">
                                    به‌خوبی آبرسانی شده‌اند و بازتاب نوری ندارند
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q1" value="4">
                                    براق هستند و نور را به‌وضوح بازتاب می‌دهند
                                </label>

                            </div>
                        </div>

                        <!-- سوال 2 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    در عکس‌ها، صورت شما براق به نظر می‌رسد؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q2" value="1" required>
                                    هرگز، یا تا به حال متوجه براق بودن آن نشده‌ام
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q2" value="2">
                                    گاهی اوقات
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q2" value="3">
                                    اغلب
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q2" value="4">
                                    همیشه
                                </label>

                            </div>
                        </div>

                        <!-- سوال 3 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    دو تا سه ساعت بعد از زدن کرم‌پودر (فاندیشن)، بدون استفاده از پودر یا پنکیک، آرایش صورت شما چه حالتی دارد؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="1" required>
                                    پوسته‌پوسته می‌شود یا داخل چین‌وچروک‌ها جمع می‌شود
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="2">
                                    صاف و یکدست است
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="3">
                                    براق می‌شود
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="4">
                                    رگه‌دار و براق می‌شود
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q3" value="5">
                                    من از کرم‌پودر استفاده نمی‌کنم
                                </label>

                            </div>
                        </div>

                        <!-- سوال 4 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    وقتی در محیطی با رطوبت پایین هستید و از مرطوب‌کننده یا ضدآفتاب استفاده نمی‌کنید، پوست صورت شما چه حالتی دارد؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="1" required>
                                    احساس خشکی شدید دارد یا ترک می‌خورد
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="2">
                                    احساس کشیدگی دارد
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="3">
                                    حالت طبیعی دارد
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="4">
                                    براق به نظر می‌رسد، یا هرگز احساس نمی‌کنم به مرطوب‌کننده نیاز دارم
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q4" value="5">
                                    نمی‌دانم
                                </label>

                            </div>
                        </div>

                        <!-- سوال 5 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    در آینه‌ی بزرگ‌نما نگاه کنید. چه تعداد منافذ بزرگ (به اندازه‌ی نوک سوزن یا بزرگ‌تر) روی صورت خود می‌بینید؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="1" required>
                                    هیچ‌کدام
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="2">
                                    فقط چند تا در ناحیه‌ی T (پیشانی و بینی)
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="3">
                                    تعداد زیادی
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="4">
                                    خیلی زیاد!
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q5" value="5">
                                    نمی‌دانم
                                </label>
                            </div>
                            <div class="alert alert-warning py-2">
                                <span>توجه: لطفاً دوباره با دقت نگاه کنید و فقط در صورتی گزینه «نمی‌دانم» را انتخاب کنید که واقعاً نتوانستید تشخیص دهید.</span>
                            </div>
                        </div>

                        <!-- سوال 6 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    به طور کلی، پوست صورت خود را چگونه توصیف می‌کنید؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q6" value="1" required>
                                    خشک
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q6" value="2">
                                    نرمال (معمولی)
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q6" value="3">
                                    مختلط
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q6" value="4">
                                    چرب
                                </label>

                            </div>
                        </div>

                        <!-- سوال 7 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    وقتی از صابونی استفاده می‌کنید که کف زیادی می‌کند (پر از حباب و کف)، پوست صورت شما چه احساسی پیدا می‌کند؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q7" value="1" required>
                                    احساس خشکی دارد یا ترک می‌خورد
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q7" value="2">
                                    حالت طبیعی دارد
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q7" value="3">
                                    احساس چربی می‌کند
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q7" value="4">
                                    من از صابون یا شوینده‌های کف‌کننده استفاده نمی‌کنم
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
                                    اگر پوست صورت خود را مرطوب نکنید، پوستتان احساس کشیدگی می‌کند:
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q8" value="1" required>
                                    همیشه
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q8" value="2">
                                    گاهی اوقات
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q8" value="3">
                                    به ندرت
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q8" value="4">
                                    هیچ وقت
                                </label>

                            </div>
                        </div>

                        <!-- سوال 9 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    شما منافذ مسدود شده (سرسیاه یا سرسفید) دارید:
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q9" value="1" required>
                                    هرگز
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q9" value="2">
                                    به ندرت
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q9" value="3">
                                    گاهی اوقات
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q9" value="4">
                                    همیشه
                                </label>

                            </div>
                        </div>

                        <!-- سوال 10 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    ناحیه‌ی T صورت شما (پیشانی و بینی) چرب است:
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q10" value="1" required>
                                    هرگز
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q10" value="2">
                                    گاهی اوقات
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q10" value="3">
                                    اغلب
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q10" value="4">
                                    همیشه
                                </label>

                            </div>
                        </div>

                        <!-- سوال 11 -->
                        <div class="card question-card shadow-sm mb-4">
                            <div class="card-body p-4">

                                <h4 class="mb-4 lh-base fw-bold" style="text-align: justify;">
                                    دو تا سه ساعت بعد از زدن مرطوب‌کننده، گونه‌های شما چه حالتی دارند؟
                                </h4>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q11" value="1" required>
                                    خیلی زبر، پوسته‌پوسته یا کدر (خاکستری)
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q11" value="2">
                                    صاف و یکدست
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q11" value="3">
                                    کمی براق
                                </label>

                                <label class="answer-item d-block">
                                    <input type="radio" name="q11" value="4">
                                    براق و چرب، یا من از مرطوب‌کننده استفاده نمی‌کنم
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

<?php endif; ?>

</html>