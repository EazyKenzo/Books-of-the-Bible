<?php
    require 'db_connect.php';

    $query = "SELECT * FROM person ORDER BY name";
    $statement = $db->prepare($query);
    $statement->execute();
    $characters = $statement->fetchAll();
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
        <div class="container-fluid"><a class="navbar-brand" href="index.html" style="font-size: 56px;color: #ffffff;">The Bible</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse text-uppercase d-xl-flex justify-content-xl-end align-items-xl-center" id="navcol-1" style="font-size: 25px;">
                <ul class="nav navbar-nav" style="color: rgb(255,255,255);">
                    <li class="nav-item" role="presentation"><a class="nav-link text-white" href="books.php" style="margin: 20px;margin-left: 20px;">Books</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link text-white" href="characters.php" style="margin: 20px;">Characters</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div>
        <h1 class="text-center" style="height: 95px;">Characters of the Bible</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <ul id="characterList" class="list">
                            <?php foreach ($characters as $character): ?>
                                <li>
                                    <p><?= $character['Name'] ?></p>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
                <div class="col"><a href="edit_character.html" style="font-size: 20px;text-decoration: none;">Add a new character</a></div>
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