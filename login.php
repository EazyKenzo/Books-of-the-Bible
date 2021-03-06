<?php
require 'db_connect.php';
require 'login/vendor/autoload.php';

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$error_msg = null;

if ($_POST) {
    try {
        $auth->loginWithUsername($username, $password);

        if ($auth->admin()->doesUserHaveRole($auth->getUserId(), \Delight\Auth\Role::ADMIN)) {
            $_SESSION['admin'] = true;
        } else {
            $_SESSION['admin'] = false;
        }

        $_SESSION['message'] = 'Login successful';
        header("Location: index.php");
        exit();
    } catch (\Delight\Auth\UnknownUsernameException $e) {
        $error_msg = "Unknown username";
    } catch (\Delight\Auth\AmbiguousUsernameException $e) {
        $error_msg = "Ambiguous Username";
    } catch (\Delight\Auth\InvalidPasswordException $e) {
        $error_msg = "Wrong password";
    } catch (\Delight\Auth\EmailNotVerifiedException $e) {
        $error_msg = "Email not verified";
    } catch (\Delight\Auth\TooManyRequestsException $e) {
        $error_msg = "Too many requests";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        Project</title>
    <link rel="stylesheet"
          href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Amaranth">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet"
          href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet"
          href="assets/css/Article-Clean.css">
    <link rel="stylesheet"
          href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet"
          href="assets/css/Footer-Dark.css">
    <link rel="stylesheet"
          href="assets/css/Highlight-Blue.css">
    <link rel="stylesheet"
          href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet"
          href="assets/css/styles.css">
</head>

<body style="background-color: rgb(56,66,67);color: #ffffff;font-family: Amaranth, sans-serif;">
<?php require 'header.php' ?>
<div class="login-dark">
    <form method="post">
        <h2 class="sr-only">
            Login
            Form</h2>
        <div class="illustration">
            <i class="icon ion-ios-locked-outline"></i>
        </div>
        <div class="form-group">
            <input class="form-control"
                   type="text"
                   placeholder="Username"
                   required=""
                   name="username">
        </div>
        <div class="form-group">
            <input class="form-control"
                   type="password"
                   name="password"
                   placeholder="Password"
                   required="">
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block"
                    type="submit">
                Log
                In
            </button>
            <label class="text-center"
                   id="error"
                   style="width: 100%;color: rgb(220,53,69);"><?php if (isset($error_msg)): ?><?= $error_msg ?><?php endif ?></label>
        </div>
        <a class="forgot"
           href="register.php">Create
            an
            account</a>
    </form>
</div>
<?php require 'footer.php' ?>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>