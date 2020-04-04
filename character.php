<?php
require 'db_connect.php';
require 'login/vendor/autoload.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query = "SELECT * FROM person WHERE Id = :id";
$statement = $db->prepare($query);
$statement->bindValue(':id', $id);
$statement->execute();
$character = $statement->fetch();

$query = "SELECT * FROM comment WHERE OnId = :id && OnTable = 1 && Visible = 1 ORDER BY Id DESC";
$statement = $db->prepare($query);
$statement->bindValue(':id', $id);
$statement->execute();
$comments = $statement->fetchAll();
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
            <div class="row">
                <div class="col-md-6" style="padding: 20px;margin-bottom: 10px;">
                    <a class="text-uppercase border rounded border-dark" href="characters.php" style="width: 109px;border-color: green;background-color: rgba(220,53,69,0.77);color: rgba(255,255,255,0.88);font-size: 13px;font-weight: bold;padding: 16px 32px;margin: 0px 15px;">BACK</a>
                    <?php if ($_SESSION['admin']): ?>
                        <a class="text-uppercase border rounded border-dark" href="edit_character.php?id=<?= $character['Id'] ?>" style="width: 109px;border-color: green;padding: 16px 32px;background-color: rgba(220,53,69,0.77);color: rgba(255,255,255,0.88);font-size: 13px;font-weight: bold;margin: 0px 15px;">EDIT</a>
                    <?php endif ?>
                </div>
            </div>
            <div class="row">
                <div class="col" style="border-top: solid black;background-color: #495051;">
                    <div style="margin: 20px;">
                        <?php foreach ($comments as $comment): ?>
                            <div style="padding: 10px;">
                                <h6><?= $comment['Username'] ?>:</h6>
                                <p style="margin-left: 10px;"><?= $comment['Content'] ?></p>
                                <?php if ($_SESSION['admin'] || (int)$comment['UserId'] === $auth->getUserId()): ?>
                                    <form method="post" style="padding: 10px;" action="process.php?id=<?= $comment['Id'] ?>">
                                        <input type="hidden" name="operation" value="comment">
                                        <input type="hidden" name="table" value="character">
                                        <button class="btn btn-primary" type="submit" name="command" value="delete" style="height: 23px;width: 53px;padding: 0px;margin: 0px 10px;">Delete</button>
                                        <?php if ($_SESSION['admin']): ?>
                                            <button class="btn btn-primary" type="submit" name="command" value="hide" style="height: 23px;width: 53px;padding: 0px;margin: 0px 10px;">Hide</button>
                                        <?php endif ?>
                                    </form>
                                <?php endif ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <?php if ($auth->isLoggedIn()): ?>
                        <div style="margin: 20px;">
                            <form method="post" style="padding: 10px;" action="process.php">
                                <textarea class="form-control" style="width: 50%;height: 100px;" name="content" required="" maxlength="5000" placeholder="Add a comment..."></textarea>
                                <input type="hidden" name="operation" value="comment">
                                <input type="hidden" name="table" value="character">
                                <input type="hidden" name="userId" value="<?= $auth->getUserId() ?>">
                                <input type="hidden" name="onId" value="<?= $id ?>">
                                <input type="hidden" name="username" value="<?= $auth->getUsername() ?>">
                                <button class="btn btn-secondary" type="submit" style="background-color: rgba(220,53,69,0.83);width: 90px;margin: 10px;">POST</button>
                            </form>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php' ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>