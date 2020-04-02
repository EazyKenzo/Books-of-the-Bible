<?php
require 'db_connect.php';
require 'login/vendor/autoload.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query = "SELECT * FROM Book WHERE Id = :id";
$statement = $db->prepare($query);
$statement->bindValue(':id', $id);
$statement->execute();
$book = $statement->fetch();

$query = "SELECT * FROM person WHERE Id = :id";
$statement = $db->prepare($query);
$statement->bindValue(':id', $book['AuthorId']);
$statement->execute();
$author = $statement->fetch();

$ends = array('th','st','nd','rd','th','th','th','th','th','th');
if (($book['BibleOrder']%100) >= 11 && ($book['BibleOrder']%100) <= 13)
    $abbreviation = $book['BibleOrder']. 'th';
else
    $abbreviation = $book['BibleOrder']. $ends[$book['BibleOrder'] % 10];
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
                <div class="col-md-12 text-center">
                    <h1 style="margin: 30px;"><?= $book['Name'] ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-unstyled">
                        <li>
                            <div class="d-flex align-items-xl-center" style="padding: 10px;">
                                <h6 class="d-xl-flex align-items-xl-center" style="margin: 10px;">Written by:&nbsp;</h6><a class="d-xl-flex align-items-xl-center" href="character.php?id=<?= $author['Id'] ?>" style="color: rgb(220,53,69);"><?= $author['Name'] ?></a></div>
                        </li>
                        <li>
                            <div style="padding: 10px;">
                                <h6 class="d-xl-flex align-items-xl-center" style="padding: 10px;margin: 0px;">Audience and Destination:</h6>
                                <p class="d-xl-flex align-items-xl-center" style="margin-left: 30px;"><?= $book['AudienceDestination'] ?></p>
                            </div>
                        </li>
                        <li>
                            <div style="padding: 10px;">
                                <p style="margin: 10px;">Number of chapters: <?= $book['Chapters'] ?></p>
                            </div>
                        </li>
                        <li>
                            <div style="padding: 10px;">
                                <p style="margin: 10px;">Written sometime around
                                    <?php if ((boolean)$book['CompletionYear']): ?>
                                        <?php if ($book['StartYear'] > 0): ?>
                                            <?= $book['StartYear'] ?> A.D.
                                        <?php else: ?>
                                            <?= $book['StartYear'] * -1 ?> B.C.
                                        <?php endif ?>
                                        and
                                        <?php if ($book['CompletionYear'] > 0): ?>
                                            <?= $book['CompletionYear'] ?> A.D.
                                        <?php else: ?>
                                            <?= $book['CompletionYear'] * -1 ?> B.C.
                                        <?php endif ?>
                                    <?php else: ?>
                                        <?php if ($book['StartYear'] > 0): ?>
                                            <?= $book['StartYear'] ?> A.D.
                                        <?php else: ?>
                                            <?= $book['StartYear'] * -1 ?> B.C.
                                        <?php endif ?>
                                    <?php endif ?>
                                </p>
                            </div>
                        </li>
                        <li>
                            <div style="padding: 10px;">
                                <p style="margin: 10px;">It is the <?= $abbreviation ?> book in the bible, which is in the
                                    <?php if ((int)$book['Testament'] === 0): ?>old
                                    <?php else: ?>new
                                    <?php endif ?>
                                    testament.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5>Summary:</h5>
                    <p><?= $book['Summary'] ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php' ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>