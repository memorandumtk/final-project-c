<?php
require "../config.php";

$dbCon = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName); //new mysqli()
if (!$dbCon) { //$dbCon->connect_error
    die("Connection error " . mysqli_connect_error()); //$dbCon->connect_error
} else {
    $deleteCategory = "DELETE FROM `category_tb`";
    $result = $dbCon->query($deleteCategory);
    echo "Result of deletion of category table.\n";
    print_r($result);
    echo "\n\n";
    $deleteCategory = "DELETE FROM `book_tb`";
    $result = $dbCon->query($deleteCategory);
    echo "Result of deletion of book table.\n";
    print_r($result);
}
