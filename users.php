<?php
require 'db_connect.php';
require 'login/vendor/autoload.php';

$query = "SELECT * FROM users";
$statement = $db->prepare($query);
$statement->execute();
$users = $statement->fetchAll();
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
<?php require 'header.php' ?>
<div>
    <h1 class="text-center" style="height: 95px;">Users</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <ul id="characterList" class="list">
                        <?php foreach ($users as $user): ?>
                            <li>
                                <a href="user.php?id=<?= $user['id'] ?>"><?= $user['username'] ?></a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <div class="col"><a href="user.php" style="font-size: 20px;text-decoration: none;">Add a new user</a></div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>