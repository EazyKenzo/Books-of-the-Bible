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
        <?php require 'header.php' ?>
        <div class="article-clean" style="background-color: rgb(56,66,67);">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="intro">
                            <p class="text-center text-danger" style="font-size: 18px;">
                                <span class="text-white by">by</span> MARKUS THIESSEN
                            </p>
                            <img
                                    src="assets/img/bible.jpg" loading="auto" width="100%">
                        </div>
                        <div class="text" style="color: rgba(255,255,255,0.67);">
                            <p>
                                This website aims to provide historic data to provide clarity on matters related to the bible;
                                including dates, writers, and content summary.
                            </p>
                            <h2 style="color: #dc3545;">Disclaimer</h2>
                            <p>
                                While I have made every attempt to ensure that the information contained in this site has been
                                obtained from reliable sources, the information in this site is for general guidance on matters
                                of interest only. The estimated dates
                                and information can vary widely based on specific facts involved due to the varying historic
                                data.
                            </p>
                            <p>
                                We are not responsible for any errors or omissions, or for any misleading result obtained from
                                the use of this information. All information in this site is provided "as is", with no guarentee
                                of completeness or accuracy.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require 'footer.php' ?>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>