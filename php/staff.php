<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require("../config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SERVER["PATH_INFO"])) {
        switch ($_SERVER["PATH_INFO"]) {
                // Taking all book information.
            case "/all-books":
                $dbCon = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
                if ($dbCon->connect_error) {
                    echo "DB connection error. " . $dbCon->connect_error;
                } else {
                    $selectAllBook = "SELECT * FROM `book_tb`";
                    $result = $dbCon->query($selectAllBook);
                    if ($result->num_rows > 0) {
                        $allBookData = [];
                        while ($book = $result->fetch_assoc()) {
                            array_push($allBookData, $book);
                        }
                        echo json_encode($allBookData);
                    } else {
                        echo "No Record";
                    }
                    $dbCon->close();
                }
                break;

                // Take the info of borrowed book.
            case "/status":
                $dbCon = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
                if ($dbCon->connect_error) {
                    echo "DB connection error. " . $dbCon->connect_error;
                } else {
                    // This is query to take neccesary data to create book object to produce book info table having status info. The information come from three tables, 'book_tb', 'category_tb' and 'book_status_tb'.
                    // $selectAllfBookWithStatus = "SELECT book_tb.book_id, book_tb.title, book_tb.description, book_tb.authors, book_tb.registered_at, book_tb.image_url, book_status_tb.borrowed_at, book_status_tb.due_back FROM book_tb LEFT JOIN book_status_tb ON book_tb.book_id = book_status_tb.book_id;";
                    $selectAllfBookWithStatus = "SELECT book_tb.book_id, book_tb.title, book_tb.description, book_tb.authors, category_tb.name, book_tb.registered_at, book_tb.image_url, book_status_tb.borrowed_at, book_status_tb.due_back FROM book_tb LEFT JOIN book_status_tb ON book_tb.book_id = book_status_tb.book_id INNER JOIN category_tb ON book_tb.book_id = category_tb.book_id;";
                    $result = $dbCon->query($selectAllfBookWithStatus);
                    if ($result->num_rows > 0) {
                        $allBookDataWithStatus = [];
                        while ($book = $result->fetch_assoc()) {
                            $book["status"] = ($book["borrowed_at"]) ? 'Borrowed' : 'Available';
                            foreach ($book as $key => $value) {
                                // for loop to change null value to hyphen(-).
                                if (!$value) {
                                    $book[$key] = '-';
                                }
                            }
                            array_push($allBookDataWithStatus, $book);
                        }
                        echo json_encode($allBookDataWithStatus);
                    } else {
                        echo null;
                    }
                    $dbCon->close();
                }
                break;

                // Delete a specific row of the book.
            case "/delete":
                if (isset($_POST["book_id"])) {
                    $dbCon = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
                    if ($dbCon->connect_error) {
                        echo "DB connection error. " . $dbCon->connect_error;
                    } else {
                        $bookId = $_POST["book_id"];
                        // Needed to be delete from 'category_tb' first.
                        $delCmd = ("DELETE FROM `category_tb` WHERE book_id = $bookId");
                        $result = mysqli_query($dbCon, $delCmd);
                        // After deleting from 'category_tb', good to delete from 'book_tb'.
                        $delCmd2 = ("DELETE FROM `book_tb` WHERE book_id = $bookId");
                        $result = mysqli_query($dbCon, $delCmd2);
                        $dbCon->close();
                        echo "this is result of deletion of info of the book. ";
                        print_r($result);
                    }
                } else {
                    echo "Can not delete since id is not set.";
                }
                break;

                // Add new book info entered from add-book.html
            case "/add-book":
                if (isset($_POST["title"]) && isset($_POST["authors"])) {
                    $dbCon = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
                    if ($dbCon->connect_error) {
                        echo "DB connection error. " . $dbCon->connect_error;
                    } else {
                        $title = $_POST["title"];
                        $description = $_POST["description"] ?: 'No description.';
                        $authors = $_POST["authors"];
                        $image_url = $_POST["image_url"];
                        // Insert book data into 'book_tb'.
                        $insCmd = $dbCon->prepare("INSERT INTO `book_tb`(`title`, `description`, `authors`, `image_url`) VALUES (?,?,?,?)");
                        $insCmd->bind_param("ssss", $title, $description, $authors, $image_url);
                        $result = $insCmd->execute();
                        if (!$result) {
                            die('Registration of new book is failed.');
                        } else {
                            echo "New book record is added.";
                        }
                        $insCmd->close();
                        // Pick the book_id of book info inserted just above.
                        $selectCmd = "SELECT * FROM `book_tb` WHERE `title` = '" . $title . "' AND `description` = '" . $description . "';";
                        $selectedBook = $dbCon->query($selectCmd);
                        if ($selectedBook->num_rows === 1) {
                            $book = $selectedBook->fetch_assoc();
                            // Insert book data into 'category_tb'.
                            $category = $_POST["category"];
                            $insCmd = $dbCon->prepare("INSERT INTO `category_tb`(`book_id`, `name`) VALUES (?,?)");
                            $insCmd->bind_param("is", $book["book_id"], $category);
                            $result = $insCmd->execute();
                            if (!$result) {
                                die('Insertion to category table is failed.');
                            } else {
                                echo "New book category is added.";
                            }
                            $insCmd->close();
                        } else {
                            echo "The book is not registered or depulicated.";
                        }
                        $dbCon->close();
                    }
                } else {
                    echo "Nesssary form data is not set.";
                }
                break;


                // Path for registering borrowing and returning.
                // Since customer borrow some book phisically on basic, I haven't implemented borrow function on front end(Javascript).
            case "/borrow":
                if (isset($_POST["book_id"]) && isset($_POST["user_id"])) {
                    $dbCon = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
                    if ($dbCon->connect_error) {
                        echo "DB connection error. " . $dbCon->connect_error;
                    } else {
                        $bookId = $_POST["book_id"];
                        $userId = $_POST["user_id"];
                        // Adding 1 week into current.
                        $due_back = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d") + 6, date("Y")));
                        $insCmd = $dbCon->prepare("INSERT INTO `book_status_tb` (book_id, user_id, due_back) VALUES (?,?,?)");
                        $insCmd->bind_param("iis", $bookId, $userId, $due_back);
                        $insCmd->execute();
                        echo "Book status is added.";
                        $insCmd->close();
                        $dbCon->close();
                    }
                } else {
                    echo "id is not set.";
                }
                break;
            case "/return":
                if (isset($_POST["book_id"]) && isset($_POST["user_id"])) {
                    $dbCon = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
                    if ($dbCon->connect_error) {
                        echo "DB connection error. " . $dbCon->connect_error;
                    } else {
                        $bookId = $_POST["book_id"];
                        $userId = $_POST["user_id"];
                        $delCmd = ("DELETE FROM `book_status_tb` WHERE book_id = $bookId && user_id = $userId");
                        mysqli_query($dbCon, $delCmd);
                        echo "Book status is deleted.";
                        $dbCon->close();
                    }
                } else {
                    echo "id is not set.";
                }
                break;
        }
    }
}
