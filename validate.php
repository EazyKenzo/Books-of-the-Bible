<?php
$authorName = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$query = "SELECT * FROM person WHERE Name = :author";
$statement = $db->prepare($query);
$statement->bindValue(':author', $authorName);
$statement->execute();
$author = $statement->fetchAll()[0];

if (isset($author))
{
    echo 1;
}
else
{
    echo 0;
}