<?php

require 'config.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (
        empty($first_name) ||
        empty($last_name) ||
        empty($phone) ||
        empty($password) ||
        empty($confirm_password)
    ) {
        $error = "تمام فیلدها الزامی هستند.";
    } elseif ($password !== $confirm_password) {
        $error = "گذرواژه و تکرار آن یکسان نیست.";
    } else {

        $stmt = $pdo->prepare("SELECT id FROM users WHERE phone = ?");
        $stmt->execute([$phone]);

        if ($stmt->rowCount() > 0) {
            $error = "این شماره تماس قبلاً ثبت شده است.";
        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("
                INSERT INTO users(first_name, last_name, phone, password)
                VALUES (?, ?, ?, ?)
            ");

            $stmt->execute([
                $first_name,
                $last_name,
                $phone,
                $hashedPassword
            ]);

            header("Location: index.php");
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
      <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
      <link rel="stylesheet" href="./assets/style.css">

    <title>صفحه ثبت نام</title>
</head>

<body class="bg-primary bg-gradient">

    <div class="container min-vh-100 d-flex justify-content-center align-items-center">

        <div class="card shadow-lg border-0 rounded-4 w-100" style="max-width: 450px;">

            <!-- Header -->
            <div class="card-header text-center text-white bg-dark bg-gradient py-4 rounded-top-4">
                <h2 class="fw-bold mb-1">ثبت نام</h2>
                <p class="mb-0 small">اطلاعات خود را وارد کنید</p>
                <?php if (!empty($error)): ?>
            </div>

            <!-- Body -->
            <div class="card-body p-4">

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

                <form method="POST">

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">نام</label>

                        <div class="input-group">
                            <input type="text"
                                class="form-control"
                                placeholder="نام خود را وارد کنید"
                                name="first_name">
                        </div>
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">فامیل</label>

                        <div class="input-group">
                            <input type="text"
                                class="form-control"
                                placeholder="فامیل خود را وارد کنید"
                                name="last_name">
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">شماره تماس</label>

                        <div class="input-group">
                            <input type="text" maxlength="11"
                                class="form-control"
                                placeholder="09xxxxxxxxx"
                                name="phone">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">گذرواژه</label>

                        <div class="input-group">
                            <input type="password"
                                class="form-control"
                                placeholder="گذرواژه"
                                name="password">
                        </div>
                    </div>

                    <!-- Repeat Password -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">تکرار گذرواژه</label>

                        <div class="input-group">
                            <input type="password"
                                class="form-control"
                                placeholder="تکرار گذرواژه"
                                name="confirm_password">
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="btn btn-primary btn-lg w-100 rounded-3 fw-bold">

                        <i class="bi bi-check-circle ms-1"></i>
                        ثبت نام

                    </button>

                </form>

            </div>

        </div>

    </div>

</body>

</html>