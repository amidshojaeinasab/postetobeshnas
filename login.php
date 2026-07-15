<?php

require 'config.php';

if (isset($_POST["login"])) {
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE phone = ?");
    $stmt->execute([$phone]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("کاربری یافت نشد");
    }

    if (!password_verify($password, $user['password'])) {
        die("گذرواژه اشتباه است");
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['first_name'];

    header("Location: dashboard.php");
}



?>


<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">


    <title>صفحه ثبت نام</title>
</head>

<body class="bg-primary bg-gradient">

    <div class="container min-vh-100 d-flex justify-content-center align-items-center">

        <div class="card shadow-lg border-0 rounded-4 w-100" style="max-width: 420px;">

            <!-- Header -->
            <div class="card-header text-center text-white bg-dark bg-gradient py-4 rounded-top-4">
                <h2 class="fw-bold mb-1">ورود</h2>
                <p class="mb-0 small">وارد حساب کاربری خود شوید</p>
            </div>

            <!-- Body -->
            <div class="card-body p-4">

                <form method="POST">

                    <!-- Phone -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            شماره تماس
                        </label>

                        <div class="input-group">

                            <input type="tel"
                                class="form-control"
                                placeholder="09xxxxxxxxx"
                                name="phone">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            گذرواژه
                        </label>

                        <div class="input-group">

                            <input type="password"
                                class="form-control"
                                placeholder="گذرواژه"
                                name="password">
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div class="form-check">
                            <input class="form-check-input"
                                type="checkbox"
                                id="rememberMe">

                            <label class="form-check-label"
                                for="rememberMe">

                                مرا به خاطر بسپار

                            </label>
                        </div>

                        <a href="#"
                            class="text-decoration-none small">

                            فراموشی رمز عبور

                        </a>

                    </div>

                    <!-- Submit -->
                    <button type="submit" name="login"
                        class="btn btn-primary btn-lg w-100 rounded-3 fw-bold">

                        <i class="bi bi-box-arrow-in-left ms-1"></i>
                        ورود

                    </button>

                </form>

                <!-- Register Link -->
                <div class="text-center mt-4">

                    <span class="text-muted">
                        حساب کاربری ندارید؟
                    </span>

                    <a href="register.php"
                        class="text-decoration-none fw-bold">

                        ثبت نام

                    </a>

                </div>

            </div>

        </div>

    </div>

</body>

</html>