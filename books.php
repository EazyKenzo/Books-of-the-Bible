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
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>