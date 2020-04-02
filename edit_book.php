<?php
require 'db_connect.php';
require 'login/vendor/autoload.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$set = false;
$userId = $auth->getUserId();

try {
    if (!$_SESSION['admin'])
        throw new Exception("You must be an admin to make changes to the database");

    if (isset($id)) {
        $set = true;

        $query = "SELECT * FROM book WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $book = $statement->fetchAll()[0];

        $query = "SELECT Name FROM person WHERE id = :authorId";
        $statement = $db->prepare($query);
        $statement->bindValue(':authorId', $book['AuthorId']);
        $statement->execute();
        $author = $statement->fetch()[0];
    }
}
catch (Exception $e) {
    $_SESSION['message'] = 'Error: '.$e->getMessage();

    if (isset($id)) {
        header("Location: book.php?id=$id");
    }
    else {
        header("Location: books.php");
    }
    exit();
}
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
    <div class="contact-clean" style="padding: 0px;background-color: #384243;">
        <div style="padding: 80px 0px;background-image: url(&quot;assets/img/bible.jpg&quot;);background-size: cover;background-position: center;">
            <form id="book_edit" method="post" style="background-color: rgba(56,66,67,0.76);color: rgba(45,45,45,0.85);" action="process.php">
                <h2 class="text-center" style="color: #c6c6c6;">New Book<br></h2>
                <div class="form-group"><label>Name</label><input class="form-control" type="text" name="name" required="" maxlength="50" <?php if($set):?> value="<?= $book['Name'] ?>"<?php endif ?>></div>
                <div class="d-flex" style="margin: 0px 0px 16px;">
                    <div class="form-group" style="margin: 0px;padding: 0px 20px 0px 0px;width: 100%;height: 90px;"><label style="margin: 0px;">Author</label><input class="form-control" type="text" id="author" required="" name="author" <?php if($set):?> value="<?= $author ?>"<?php endif ?>>
                        <p class="text-center" id="error" style="margin: 0px;color: #c51111;">Author doesn't exist</p>
                    </div>
                    <div class="form-group d-flex d-xl-flex align-items-center align-items-sm-center align-items-lg-center align-items-xl-center" style="margin: 0px;"><select class="form-control" style="color: rgba(86,86,86,0.85);width: 129px;padding: 6px 0px;" required="" name="testament"><option value="" selected="" id="test" hidden="" disabled="" color="#ba2575">Testament</option><option value="0" <?php if($set && $book['Testament'] === '0'):?> selected=""<?php endif ?>>Old Testament</option><option value="1" <?php if($set && $book['Testament'] === '1'):?> selected=""<?php endif ?>>New Testament</option></select></div>
                </div>
                <div class="form-group"><label>Summary</label><textarea class="form-control" style="height: 141px;" name="summary" required="" maxlength="4000"><?php if($set):?><?= $book['Summary'] ?><?php endif ?></textarea></div>
                <div class="form-group d-flex d-xl-flex justify-content-center justify-content-sm-center justify-content-xl-center"
                    style="width: 100%;">
                    <div style="width: 50%;"><label>Start year</label><input class="form-control" type="number" style="width: 120px;margin-right: 10px;" required="" max="9999" name="start" <?php if($set):?> value="<?= $book['StartYear'] ?>"<?php endif ?>></div>
                    <div><label>Completion year</label><input class="form-control" type="number" style="width: 120px;margin-left: 10px;" max="9999" name="end" <?php if($set):?> value="<?= $book['CompletionYear'] ?>"<?php endif ?>></div>
                </div>
                <div class="form-group"><label>First Audience and Destination</label><textarea class="form-control" maxlength="2000" name="audience"><?php if($set):?><?= $book['AudienceDestination'] ?><?php endif ?></textarea></div>
                <div class="d-flex d-xl-flex justify-content-center justify-content-sm-center justify-content-xl-center">
                    <div class="form-group" style="width: 50%;margin: 0px;"><label>Number of Chapters</label><input class="form-control" type="number" style="width: 120px;margin-right: 10px;" max="999" required="" name="chapters" <?php if($set):?> value="<?= $book['Chapters'] ?>"<?php endif ?>></div>
                    <div class="form-group d-flex flex-column justify-content-end" style="margin: 0px;"><label>Order in Bible</label><input class="form-control d-flex" type="number" required="" max="99" name="order" style="width: 120px;margin: 0px 0px 0px 10px;" <?php if($set):?> value="<?= $book['BibleOrder'] ?>"<?php endif ?>></div>
                </div>
                <div class="form-group d-flex d-xl-flex justify-content-center justify-content-xl-center" style="margin: 30px 0px 0px 0px;width: 100%;">
                    <button class="btn btn-secondary" type="submit" name="command" value="update" style="background-color: rgba(220,53,69,0.83);width: 109px;margin: 0px 15px;">SAVE</button>
                    <?php if ($set): ?>
                        <button class="btn btn-secondary" type="submit" name="command" value="delete" style="background-color: rgba(220,53,69,0.83);width: 109px;margin: 0px 15px;" onclick="return confirm('Are you sure you wish to delete this book?')">DELETE</button>
                    <?php endif ?>
                    <a
                            class="text-uppercase border rounded border-dark" href="<?php if($set): ?>book.php?id=<?= $book['Id'] ?><?php else: ?>books.php<?php endif ?>" style="width: 109px;border-color: green;margin: 0px 15px;padding: 16px 32px;background-color: rgba(220,53,69,0.77);color: rgba(255,255,255,0.88);font-size: 13px;font-weight: bold;">CANCEL
                    </a>
                </div>
                <input class="form-control" type="hidden" name="id" value="<?php if($set):?><?= $id ?><?php else: ?>-1<?php endif ?>">
                <input class="form-control" type="hidden" name="operation" value="books"></form>
        </div>
    </div>
    <?php require 'footer.php' ?>
    <script src="Javascript/jquery.js"></script>
    <script src="Javascript/book_validation.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>