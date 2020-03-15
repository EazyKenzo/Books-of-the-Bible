<?php
    define('DB_DSN','mysql:host=localhost;dbname=booksofthebible');
    define('DB_USER','projectuser');
    define('DB_PASS','cation34');
    
    try {
        // Create a PDO object called $db.
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        print "Error: " . $e->getMessage();
        die(); // Force execution to stop on errors.
    }
?>