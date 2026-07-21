<?php
require 'config.php';
is_login();

$stmt = $pdo->prepare("SELECT is_paid FROM users WHERE id=?");
$stmt->execute([$_SESSION['user_id']]);

$user = $stmt->fetch();

if ($user['is_paid'] == 1) {
    header("Location: oilyform.php");
    exit;
}
?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <title>پرداخت</title>

</head>

<body>

    <h2>

        برای شروع آزمون ابتدا هزینه را پرداخت کنید.

    </h2>

    <form action="pay.php" method="post">

        <button type="submit">

            پرداخت آزمون

        </button>

    </form>

</body>

</html>