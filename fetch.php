<?php

require 'db_connect.php';

$ajax_data = [
    "success" => false,
    "message" => 'No books found',
    "books" => []
];

$filter = filter_input(INPUT_GET, 'filter', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$books = [];

if ($filter === "author") {
    $query = "SELECT Id FROM person WHERE Name = :name";
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $search);
    $statement->execute();
    $id = $statement->fetch()[0];

    $query = "SELECT Id, Name FROM book WHERE AuthorId = :authorId";
    $statement = $db->prepare($query);
    $statement->bindValue(':authorId', $id);
    $statement->execute();
    $books = $statement->fetchAll(PDO::FETCH_ASSOC);
}
else if ($filter === "name") {
    $query = "SELECT Id, Name FROM book WHERE Name = :name";
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $search);
    $statement->execute();
    $books = $statement->fetchAll(PDO::FETCH_ASSOC);
}
else if ($filter === "date") {
    $from = filter_input(INPUT_GET, 'from', FILTER_SANITIZE_NUMBER_INT);
    $to = filter_input(INPUT_GET, 'to', FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT Id, Name FROM book WHERE StartYear BETWEEN :from AND :to";
    $statement = $db->prepare($query);
    $statement->bindValue(':from', $from);
    $statement->bindValue(':to', $to);
    $statement->execute();
    $books = $statement->fetchAll(PDO::FETCH_ASSOC);
}
else if ($filter === "testament") {
    $testament = filter_input(INPUT_GET, 'testament', FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT Id, Name FROM book WHERE Testament = :testament";
    $statement = $db->prepare($query);
    $statement->bindValue(':testament', $testament);
    $statement->execute();
    $books = $statement->fetchAll(PDO::FETCH_ASSOC);
}

$num_of_books = count($books);

if ($num_of_books === 0) {
    $ajax_data['message'] = "No books found";
} else {
    $ajax_data['success'] = true;
    $ajax_data['message'] = "Found {$num_of_books} books";
    $ajax_data['books'] = $books;
}

header('Content-Type: application/json');
echo json_encode($ajax_data);
?>