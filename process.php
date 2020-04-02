<?php
require 'db_connect.php';
require 'login/vendor/autoload.php';

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$operation = filter_input(INPUT_POST, 'operation', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$command = filter_input(INPUT_POST, 'command', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

try {
    if (!$_SESSION['admin'])
        throw new Exception("You must be an admin to make changes to the database");

    if ($operation === "characters") {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $summary = filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $meaning = filter_input(INPUT_POST, 'meaning', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($id < 0) {
            $query = "INSERT INTO person (Name, Summary, Meaning) values (:name, :summary, :meaning)";
            $statement = $db->prepare($query);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':summary', $summary);
            $statement->bindValue(':meaning', $meaning);
            $statement->execute();

            $_SESSION['message'] = 'Character added successfully.';
            header("Location: $operation.php");
        } else {
            if ($command === 'update') {
                $query = "UPDATE person SET Name = :name, Summary = :summary, Meaning = :meaning WHERE Id = :id";
                $statement = $db->prepare($query);
                $statement->bindValue(':name', $name);
                $statement->bindValue(':summary', $summary);
                $statement->bindValue(':meaning', $meaning);
                $statement->bindValue(':id', $id, PDO::PARAM_INT);
                $statement->execute();

                $_SESSION['message'] = 'Character modified successfully.';

                header("Location: $operation.php");
            } elseif ($command === 'delete') {
                $query = "DELETE FROM person WHERE Id = :id";
                $statement = $db->prepare($query);
                $statement->bindValue(':id', $id, PDO::PARAM_INT);
                $statement->execute();

                $_SESSION['message'] = 'Character deleted successfully.';
                header("Location: $operation.php");
            }
        }
    } elseif ($operation === "books") {
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

        if ($id < 0) {
            $query = "INSERT INTO book (Name, Testament, Chapters, AudienceDestination, Summary, StartYear, CompletionYear, AuthorId, BibleOrder)
                values (:name, :testament, :chapters, :audience, :summary, :start, :end, :authorId, :order)";
            $statement = $db->prepare($query);
            $bind_values = ['name' => $name, 'testament' => $testament, 'chapters' => $chapters, 'audience' => $audience, 'summary' => $summary, 'start' => $start, 'end' => $end, 'authorId' => $authorId, 'order' => $order];
            $statement->execute($bind_values);

            $_SESSION['message'] = 'Book added successfully.';
            header("Location: $operation.php");
        } else {
            if ($command === 'update') {
                $query = "UPDATE book SET Name = :name, Testament = :testament, Chapters= :chapters, AudienceDestination = :audience, Summary = :summary, StartYear = :start, CompletionYear = :end, AuthorId = :authorId, BibleOrder = :order WHERE Id = :id";
                $statement = $db->prepare($query);
                $bind_values = ['name' => $name, 'testament' => $testament, 'chapters' => $chapters, 'audience' => $audience, 'summary' => $summary, 'start' => $start, 'end' => $end, 'authorId' => $authorId, 'order' => $order, 'id' => $id];
                $statement->execute($bind_values);

                $_SESSION['message'] = 'Book modified successfully.';
                header("Location: $operation.php");
            } elseif ($command === 'delete') {
                $query = "DELETE FROM book WHERE Id = :id";
                $statement = $db->prepare($query);
                $statement->bindValue(':id', $id, PDO::PARAM_INT);
                $statement->execute();

                $_SESSION['message'] = 'Book deleted successfully.';
                header("Location: $operation.php");
            }
        }
    }
    else
    {
        throw new Exception("Unknown operation");
    }
}
catch (Exception $e) {
    $_SESSION['message'] = 'Error: '.$e->getMessage();
    header("Location: index.php");
}