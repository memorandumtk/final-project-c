<?php
require "../config.php";

function storeBook($book, $dbCon)
{
    $title = $book['volumeInfo']['title'];
    // If there is needs to take ISBN of the book, can use 'seach-isbn.php'.
    $description = $book['volumeInfo']['description'] ?: 'No description.';
    $authors = implode(", ", $book['volumeInfo']['authors']);
    $image_url = $book['volumeInfo']['imageLinks']['thumbnail'];

    // Store a book data
    $insBook = $dbCon->prepare("INSERT INTO book_tb (`title`,`description`,`authors`,`image_url`) VALUES (?,?,?,?)");
    $insBook->bind_param("ssss", $title, $description, $authors, $image_url);
    $insBook->execute();
    echo "Title: " . $title . " is stored.";
    echo "\n\n";
    $insBook->close();
}


function storeCategory($book, $dbCon)
{
    // Take id of the book to store a category
    $title = $book['volumeInfo']['title'];
    $category = $book['volumeInfo']['categories'][0];
    $selectCmd = 'SELECT * FROM book_tb WHERE title="' . $title . '"';
    $result = $dbCon->query($selectCmd);
    if ($result->num_rows > 0) {
        $bookIns = $result->fetch_assoc();
        // print_r($bookIns);
        $bookId = $bookIns['book_id'];
    } else {
        die('Failed to take book id.');
    }
    // Store a category
    $insBook = $dbCon->prepare("INSERT INTO category_tb (`book_id`,`name`) VALUES (?,?)");
    $insBook->bind_param("is", $bookId, $category);
    $insBook->execute();
    echo $title . "'s category is also stored.";
    echo "\n\n";
    $insBook->close();
}



$queries = ['PHP', 'Vancouver']; // Replace with your search query
$dbCon = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName); //new mysqli()
if (!$dbCon) { //$dbCon->connect_error
    die("Connection error " . mysqli_connect_error()); //$dbCon->connect_error
} else {
    foreach ($queries as $query) {
        $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($query);
        $response = file_get_contents($url);
        if ($response !== false) {
            $data = json_decode($response, true);
            foreach ($data['items'] as $book) {
                storeBook($book, $dbCon);
                storeCategory($book, $dbCon);
            }
        } else {
            echo "Error fetching data.";
        }
    }
    $dbCon->close();
}
