<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
include("./databaseInfo.php");
include("./bookClass.php");
include("./statusClass.php");

$connection = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);

function query($connection, $query)
{
    return mysqli_query($connection, $query);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SERVER["PATH_INFO"])) {
        switch ($_SERVER["PATH_INFO"]) {
            case "/allbooks":
                $query = "SELECT * FROM book_tb";
                $bookdata = query($connection, $query);

                while ($row = mysqli_fetch_assoc($bookdata)) {
                    $book = new BookClass(
                        $row["book_id"],
                        $row["title"],
                        $row["description"],
                        $row["authors"],
                        $row["registered_at"],
                        $row["image_url"]
                    );
                    $books[] = array_map('strval', array_values((array) $book));
                }
                echo json_encode($books);
                break;

            case "/borrBooks":
                $query = "SELECT s.status_id, b.title,b.authors,s.borrowed_at, s.due_back FROM book_tb b, book_status_tb s WHERE b.book_id = s.book_id";
                $statusData = query($connection, $query);
                $stArray = null;

                while ($row = mysqli_fetch_assoc($statusData)) {
                    $status = new StatusClass(
                        $row["status_id"],
                        $row["title"],
                        $row["authors"],
                        $row["borrowed_at"],
                        $row["due_back"]
                    );
                    $stArray[] = array_map('strval', array_values((array) $status));
                }
                echo json_encode($stArray);
                break;

            case "/avbooks":
                $query = "SELECT b.title, b.authors
                FROM book_tb b
                LEFT JOIN book_status_tb s ON b.book_id = s.book_id
                WHERE s.book_id IS NULL";
                $statusdata = query($connection, $query);

                while ($row = mysqli_fetch_assoc($statusdata)) {
                    $status = new StatusClass(
                        null,
                        $row["title"],
                        $row["authors"],
                        null,
                        date('Y-m-d', strtotime('+1 week'))
                    );
                    $stArray[] = array_map('strval', array_values((array) $status));
                }
                echo json_encode($stArray);
                break;
        }
    }
}
