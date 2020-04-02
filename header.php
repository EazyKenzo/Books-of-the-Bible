<?php
require 'db_connect.php';
require 'login/vendor/autoload.php';

$message = null;

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}

$_SESSION['message'] = null;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Project</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amaranth">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Article-Clean.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="assets/css/Highlight-Blue.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="background-color: rgb(56,66,67);color: #ffffff;font-family: Amaranth, sans-serif;">
    <nav class="navbar navbar-light navbar-expand-md">
        <div class="container-fluid"><a class="navbar-brand" href="index.php" style="background-image: url(&quot;assets/img/icon.png&quot;);background-repeat: no-repeat;background-size: 80%;width: 130px;background-position: center;height: 150px;"></a><button data-toggle="collapse"
                class="navbar-toggler" data-target="#navcol-2"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="books.php" style="color: rgba(255,255,255,0.67);font-size: 30px;margin: 10px;">Books</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="characters.php" style="color: rgba(255,255,255,0.67);margin: 10px;font-size: 30px;">Characters</a></li>
                    <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="users.php" style="color: rgba(255,255,255,0.67);margin: 10px;font-size: 30px;">Users</a></li>
                    <?php endif ?>
                </ul>
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="<?php if ($auth->isLoggedIn()): ?>logout.php<?php else: ?>login.php<?php endif ?>" style="color: rgba(255,255,255,0.67);font-size: 20px;"><?php if ($auth->isLoggedIn()): ?><?php if ($_SESSION['admin']): ?>(Admin) <?php endif ?>Log out<?php else: ?>Log in<?php endif ?></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <h2 class="text-center<?php if(!isset($message)):?> d-none<?php endif ?>" style="color: #ff2f2f;height: 112px;"><?= $message ?></h2>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>