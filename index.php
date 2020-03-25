<?php
require 'db_connect.php';
require 'login/vendor/autoload.php';
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
    <div class="article-clean" style="background-color: rgb(56,66,67);">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="intro">
                        <p class="text-center text-white" style="font-size: 18px;"><span class="by">by</span> <a class="text-danger" href="about.html">Markus Thiessen</a></p><img src="assets/img/bible.jpg" loading="auto" width="100%"></div>
                    <div class="text" style="color: rgba(255,255,255,0.67);">
                        <p>This website aims to provide historic data to provide clarity on matters related to the bible; including dates, writers, and content summary.</p>
                        <p>Praesent sed lobortis mi. Suspendisse vel placerat ligula. Vivamus ac lacus. <strong>Ut vehicula rhoncus</strong> elementum. Etiam quis tristique lectus. Aliquam in arcu eget velit <em>pulvinar dict</em> vel in justo. Vestibulum
                            ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p>
                        <h2 style="color: #dc3545;">Disclaimer</h2>
                        <p>While I have made every attempt to ensure that the information contained in this site has been obtained from reliable sources, the information in this site is for general guidance on matters of interest only. The estimated dates
                            and information can vary widely based on specific facts involved due to the varying historic data.</p>
                        <p>We are not responsible for any errors or omissions, or for any misleading result obtained from the use of this information. All information in this site is provided "as is", with no guarentee of completeness or accuracy.</p>
                    </div>
                </div>
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
                            <li><a href="index.php">Homepage</a></li>
                            <li><a href="books.php">Books</a></li>
                            <li><a href="characters.php">Characters</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-3 item">
                        <h3>About</h3>
                        <ul>
                            <li><a href="#">Developer</a></li>
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