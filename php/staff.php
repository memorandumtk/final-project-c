<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require("../config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SERVER["PATH_INFO"])) {
        switch ($_SERVER["PATH_INFO"]) {
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
        }
    }
}
