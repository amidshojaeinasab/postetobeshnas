<?php
require 'config.php';
is_login();

$user_id = $_SESSION['user_id'];

/* گرفتن اطلاعات کاربر لاگین شده */
function getUser($pdo, $user_id)
{
    $stmt = $pdo->prepare("
        SELECT first_name, last_name, phone, email, password, id
        FROM users
        WHERE id = :id
        LIMIT 1
    ");

    $stmt->execute([
        ':id' => $user_id
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$users = getUser($pdo, $user_id);

/* آپدیت اطلاعات */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $pdo->prepare("
        UPDATE users 
        SET first_name = :first_name,
            last_name  = :last_name,
            phone      = :phone,
            email      = :email,
            password   = :password
        WHERE id = :id
    ");

    $stmt->execute([
        ':first_name' => $_POST['first_name'],
        ':last_name'  => $_POST['last_name'],
        ':phone'      => $_POST['phone'],
        ':email'      => $_POST['email'],
        ':password'   => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ':id'         => $user_id
    ]);

    // 🔥 مهم: جلوگیری از ارسال دوباره در رفرش
    header("Location: " . $_SERVER['PHP_SELF'] . "?updated=1");
    exit;
}

?>


<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پروفایل کاربر</title>

    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="assets/style.css">

</head>

<body class="profile-body">

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-12 col-md-8 col-lg-6">

                <div class="card shadow-lg border-0 rounded-4">

                    <!-- Header -->
                    <div class="card-header text-white text-center py-3 rounded-top-4 bg-header">
                        <h5 class="mb-0">پروفایل کاربری</h5>
                    </div>

                    <!-- Body -->
                    <div class="card-body p-4">

                        <h6 class="text-center mb-4 text-muted">ویرایش اطلاعات کاربر</h6>

                        <form method="POST">

                            <input type="hidden" name="id" value="<?= $users['id'] ?>">

                            <div class="mb-3">
                                <label class="form-label">نام</label>
                                <input type="text" name="first_name"
                                    value="<?= $users['first_name'] ?>"
                                    class="form-control form-control-lg rounded-3">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">نام خانوادگی</label>
                                <input type="text" name="last_name"
                                    value="<?= $users['last_name'] ?>"
                                    class="form-control form-control-lg rounded-3">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">شماره تلفن</label>
                                <input type="text" name="phone"
                                    value="<?= $users['phone'] ?>"
                                    class="form-control form-control-lg rounded-3">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">ایمیل</label>
                                <input type="text" name="email"
                                    value="<?= $users['email'] ?>"
                                    class="form-control form-control-lg rounded-3">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">رمز عبور جدید</label>
                                <input type="password" name="password"
                                    class="form-control form-control-lg rounded-3"
                                    placeholder="در صورت تغییر وارد کنید">
                            </div>

                            <button type="submit" class="btn btn-outline-custom btn-lg w-100 rounded-3">
                                ویرایش اطلاعات
                            </button>

                        </form>
                        <a href="dashboard.php" class="btn btn-outline-custom btn-lg px-5 w-100 mt-4">
                            داشبورد
                        </a>



                    </div>

                </div>

            </div>

        </div>

    </div>



</body>

</html>