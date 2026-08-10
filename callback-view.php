<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= htmlspecialchars($title) ?></title>

    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">

    <link rel="stylesheet" href="assets/style.css">

</head>

<body>

<div class="row justify-content-center">

    <div class="col-lg-6">

        <div class="card-callback p-5 text-center">

            <?php if ($type === "success") { ?>

                <div class="icon-callback text-success mb-3">
                    ✔
                </div>

            <?php } else { ?>

                <div class="icon-callback text-danger mb-3">
                    ✖
                </div>

            <?php } ?>


            <h2 class="mb-3">
                <?= htmlspecialchars($title) ?>
            </h2>


            <p class="text-muted mb-4">
                <?= htmlspecialchars($message) ?>
            </p>


            <?php

            if ($button) {
                echo $button;
            }

            ?>

        </div>

    </div>

</div>

</body>

</html>