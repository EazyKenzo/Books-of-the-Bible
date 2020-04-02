<?php
require 'db_connect.php';
require 'login/vendor/autoload.php';

$auth->logOut();

$_SESSION['admin'] = false;
$_SESSION['message'] = 'Log out successful';

header("Location: index.php");