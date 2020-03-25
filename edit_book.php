<?php
require 'db_connect.php';
require 'login/vendor/autoload.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$set = false;
$userId = $auth->getUserId();

if (isset($userId)) {
    if ($auth->admin()->doesUserHaveRole($userId, \Delight\Auth\Role::ADMIN)) {
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
    else {
        header("Location: index.php");
    }
}
else {
    header("Location: login.php");
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
<nav class="navbar navbar-light navbar-expand-md">
    <div class="container-fluid"><a class="navbar-brand" href="index.php" style="background-image: url(&quot;assets/img/icon.png&quot;);background-repeat: no-repeat;background-size: 80%;width: 130px;background-position: center;height: 150px;"></a><button data-toggle="collapse"
                                                                                                                                                                                                                                                               class="navbar-toggler" data-target="#navcol-2"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-2">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item" role="presentation"><a class="nav-link active" href="books.php" style="color: rgba(255,255,255,0.67);font-size: 30px;margin: 10px;">Books</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="characters.php" style="color: rgba(255,255,255,0.67);margin: 10px;font-size: 30px;">Characters</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color: rgba(255,255,255,0.67);font-size: 30px;margin: 10px;">Users</a></li>
            </ul>
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation"><a class="nav-link" href="<?php if ($auth->isLoggedIn()): ?>logout.php<?php else: ?>login.php<?php endif ?>" style="color: rgba(255,255,255,0.67);font-size: 20px;"><?php if ($auth->isLoggedIn()): ?>Log out<?php else: ?>Log in<?php endif ?></a></li>
            </ul>
        </div>
    </div>
</nav>
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
                <div class="form-group d-flex d-xl-flex justify-content-center justify-content-xl-center" style="margin: 30px 0px 0px 0px;width: 100%;"><button class="btn btn-secondary" id="bookButton" type="submit" style="background-color: rgba(220,53,69,0.83);width: 109px;">SAVE</button></div><input class="form-control" type="hidden" name="id" value="<?php if($set):?><?= $id ?><?php else: ?>-1<?php endif ?>"><input class="form-control"
                    type="hidden" name="operation" value="books"></form>
        </div>
    </div>
    <div class="footer-dark">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-3 item">
                        <h3>Navigate&nbsp;</h3>
                        <ul>
                            <li><a href="index.html">Homepage</a></li>
                            <li><a href="books.php">Books</a></li>
                            <li><a href="characters.php">Characters</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-3 item">
                        <h3>About</h3>
                        <ul>
                            <li><a href="about.html">Developer</a></li>
                            <li><a href="https://catalogue.rrc.ca/Programs/WPG/Fulltime/BUSGF-DP/CoursesAndDescriptions/WEBD-2008">Program</a></li>
                            <li><a href="https://www.rrc.ca/">College</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 item text">
                        <h3>Books of the Bible</h3>
                        <p><strong>Web Development 2 project - 2020</strong><br></p>
                    </div>
                </div>
                <p class="copyright">Markus Thiessen © 2020</p>
            </div>
        </footer>
    </div><script src="Javascript/jquery.js"></script>
<script src="Javascript/book_validation.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>