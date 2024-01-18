<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include("./databaseInfo.php");

$connection = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);
function query($connection, $query)
{
    return mysqli_query($connection, $query);
}
// $data = json_decode(file_get_contents("php://input"));
$val = json_decode($_POST["val"]);
$sessionId = $_POST["sessionId"];

if (isset($val)) {
    // print_r($data->val);
    $title = $val[1];
    $author = $val[2];
    $val[3] = date("Y-m-d");
    $borrowed_at = $val[3];
    $due_back = $val[4];
    print_r($val);
    session_id($_POST["sessionId"]);
    session_start();
    // print_r($_SESSION);
    $user_id = $_SESSION["loginUser"]["uid"];

    $queryb = "SELECT book_id FROM book_tb WHERE title = '$title' AND authors = '$author' ";
    $result = query($connection, $queryb);
    while ($row = mysqli_fetch_assoc($result)) {
        $book_id = $row["book_id"];
    }

    $query = $connection->prepare("INSERT INTO book_status_tb (book_id, user_id, borrowed_at, due_back) VALUES (?,?,?,?)");
    $query->bind_param("iiss", $book_id, $user_id, $borrowed_at, $due_back);
    $query->execute();
}
