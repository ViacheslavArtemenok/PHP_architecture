<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE BRAND OF LUXERIOUS FASHION</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/img_other/logo.svg" type="image/x-icon">
</head>

<body>
    <?php require_once "controller.php" ?>
    <?php require_once $header ?>
    <?php require_once $content ?>
    <?php require_once $footer ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>

</html>