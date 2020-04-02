<?php
require 'db_connect.php';
require 'login/vendor/autoload.php';

$title = '';
$message = '';

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$operation = filter_input(INPUT_POST, 'operation', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$command = filter_input(INPUT_POST, 'command', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

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
        if ($command === 'update')
        {
            $query = "UPDATE person SET Name = :name, Summary = :summary, Meaning = :meaning WHERE Id = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':summary', $summary);
            $statement->bindValue(':meaning', $meaning);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $title = 'Success';
            $message = 'Character modified successfully.';
        }
        elseif ($command === 'delete')
        {
            $query = "DELETE FROM person WHERE Id = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $title = 'Success';
            $message = 'Character deleted successfully.';
        }
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
        if ($command === 'update')
        {
            $query = "UPDATE book SET Name = :name, Testament = :testament, Chapters= :chapters, AudienceDestination = :audience, Summary = :summary, StartYear = :start, CompletionYear = :end, AuthorId = :authorId, BibleOrder = :order WHERE Id = :id";
            $statement = $db->prepare($query);
            $bind_values = ['name' => $name, 'testament' => $testament, 'chapters' => $chapters, 'audience' => $audience, 'summary' => $summary, 'start' => $start, 'end' => $end, 'authorId' => $authorId, 'order' => $order, 'id' => $id];
            $statement->execute($bind_values);

            $title = 'Success';
            $message = 'Book modified successfully.';
        }
        elseif ($command === 'delete')
        {
            $query = "DELETE FROM book WHERE Id = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $title = 'Success';
            $message = 'Book deleted successfully.';
        }
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
        <?php require 'header.php' ?>
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
        <?php require 'footer.php' ?>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>