<?php
require 'login/vendor/autoload.php';

try {
    $db = new PDO('mysql:dbname=booksofthebible;host=localhost;charset=utf8mb4', 'projectuser', 'cation34');
} catch (PDOException $e) {
    print "Error: " . $e->getMessage();
    die();
}

$auth = new \Delight\Auth\Auth($db);
?>