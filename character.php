<?php
require 'db_connect.php';
require 'login/vendor/autoload.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query = "SELECT * FROM person WHERE Id = :id";
$statement = $db->prepare($query);
$statement->bindValue(':id', $id);
$statement->execute();
$character = $statement->fetch();
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
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center" style="margin: 30px;"><?= $character['Name'] ?></h1>
                    <ul class="list-unstyled">
                        <li>
                            <div style="padding: 20px;">
                                <p>Name meaning:&nbsp;<?= $character['Meaning'] ?></p>
                            </div>
                        </li>
                        <li>
                            <div style="padding: 20px;">
                                <h5>Summary:</h5>
                                <p><?= $character['Summary'] ?></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <a
                class="text-uppercase border rounded border-dark" href="books.php" style="width: 109px;border-color: green;margin: 0px 15px;padding: 16px 32px;background-color: rgba(220,53,69,0.77);color: rgba(255,255,255,0.88);font-size: 13px;font-weight: bold;">BACK
            </a>
            <?php if ($_SESSION['admin']): ?>
                <a
                    class="text-uppercase border rounded border-dark" href="edit_character.php?id=<?= $character['Id'] ?>" style="width: 109px;border-color: green;margin: 0px 15px;padding: 16px 32px;background-color: rgba(220,53,69,0.77);color: rgba(255,255,255,0.88);font-size: 13px;font-weight: bold;">EDIT
                </a>
            <?php endif ?>
        </div>
    </div>
    <?php require 'footer.php' ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>