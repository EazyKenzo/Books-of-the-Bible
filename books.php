<?php
    require 'db_connect.php';
    require 'login/vendor/autoload.php';

    $query = "SELECT * FROM book ORDER BY bibleorder";
    $statement = $db->prepare($query);
    $statement->execute();
    $books = $statement->fetchAll();
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
        <h1 class="text-center" style="height: 151px;">Books of the Bible</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>Old Testament</h4>
                    <div>
                        <ul id="newList" class="list">
                            <?php foreach ($books as $book):
                                if ($book['Testament'] === '0'): ?>
                                    <li>
                                        <p><?= $book['Name'] ?></p>
                                    </li>
                                <?php endif;
                            endforeach ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>New Testament</h4>
                    <div>
                        <ul id="oldList" class="list">
                            <?php foreach ($books as $book):
                                if ($book['Testament'] === '1'): ?>
                                    <li>
                                        <p><?= $book['Name'] ?></p>
                                    </li>
                                <?php endif;
                            endforeach ?>
                        </ul>
                    </div>
                </div>
                <div class="col"><a href="edit_book.php" style="font-size: 20px;">Add a new book</a></div>
            </div>
        </div>
    </div>
    <?php require 'footer.php' ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>