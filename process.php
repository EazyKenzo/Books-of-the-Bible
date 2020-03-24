<?php
require 'db_connect.php';

$title = '';
$message = '';

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$operation = filter_input(INPUT_POST, 'operation', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($operation === "characters")
{
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $summary = filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $meaning = filter_input(INPUT_POST, 'meaning', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($id < 0)
    {
        $query = "INSERT INTO person (Name, Summary, Meaning) values (:name, :summary, :meaning)";
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':summary', $summary);
        $statement->bindValue(':meaning', $meaning);
        $statement->execute();

        $title = 'Success';
        $message = 'Character added successfully.';
    }
    else
    {
        $query = "UPDATE person SET Name = :name, Summary = :summary, Meaning = :meaning WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':summary', $summary);
        $statement->bindValue(':meaning', $meaning);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $title = 'Success';
        $message = 'Character modified successfully.';
    }
}
elseif ($operation === "books")
{
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $testament = filter_input(INPUT_POST, 'testament', FILTER_SANITIZE_NUMBER_INT);
    $chapters = filter_input(INPUT_POST, 'chapters', FILTER_SANITIZE_NUMBER_INT);
    $audience = filter_input(INPUT_POST, 'audience', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $summary = filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $start = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_NUMBER_INT);
    $end = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_NUMBER_INT);
    $authorName = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $order = filter_input(INPUT_POST, 'order', FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT Id FROM person WHERE Name = :authorName";
    $statement = $db->prepare($query);
    $statement->bindValue(':authorName', $authorName);
    $statement->execute();
    $authorId = (int)$statement->fetch()[0];

    if ($id < 0)
    {
        $query = "INSERT INTO book (Name, Testament, Chapters, AudienceDestination, Summary, StartYear, CompletionYear, AuthorId, BibleOrder)
            values (:name, :testament, :chapters, :audience, :summary, :start, :end, :authorId, :order)";
        $statement = $db->prepare($query);
        $bind_values = ['name' => $name, 'testament' => $testament, 'chapters' => $chapters, 'audience' => $audience, 'summary' => $summary, 'start' => $start, 'end' => $end, 'authorId' => $authorId, 'order' => $order];
        $statement->execute($bind_values);

        $title = 'Success';
        $message = 'Book added successfully.';
    }
    else
    {
        $query = "UPDATE book SET Name = :name, Testament = :testament, Chapters= :chapters, AudienceDestination = :audience, Summary = :summary, StartYear = :start, CompletionYear = :end, AuthorId = :authorId, BibleOrder = :order WHERE id = :id";
        $statement = $db->prepare($query);
        $bind_values = ['name' => $name, 'testament' => $testament, 'chapters' => $chapters, 'audience' => $audience, 'summary' => $summary, 'start' => $start, 'end' => $end, 'authorId' => $authorId, 'order' => $order, 'id' => $id];
        $statement->execute($bind_values);

        $title = 'Success';
        $message = 'Book modified successfully.';
    }
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
        <div class="highlight-blue" style="padding: 0px;background-color: rgb(56,66,67);">
            <div style="background-image: url(&quot;assets/img/bible.jpg&quot;);height: 1070px;padding: 80px 0px;background-size: cover;background-position: center;">
                <div class="container" style="width: 480px;height: 910px;padding: 40px;background-color: rgba(56,66,67,0.76);">
                    <div class="intro">
                        <h2 class="text-center" id="heading"><?= $title ?></h2>
                        <p class="text-center" id="message"><?= $message ?></p>
                    </div>
                    <div class="buttons"><a class="btn btn-primary" role="button" id="return" href="<?= $operation ?>.php" style="background-color: rgba(220,53,69,0.83);border: none;">Return to <?= $operation ?></a></div>
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