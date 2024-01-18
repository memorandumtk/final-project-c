<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include("./databaseInfo.php");

$connection = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);
function query($connection, $query)
{
    return mysqli_query($connection, $query);
}
$data = json_decode(file_get_contents("php://input"));

if (isset($data->val)) {
    print_r($data->val);
    $title = $data->val[1];
    $author = $data->val[2];
    $data->val[3] = date("Y-m-d");
    $borrowed_at = $data->val[3];
    $due_back = $data->val[4];
    $book_id = 0;
    // echo session_id();
    echo json_encode($_SESSION["loginUser"]);
    // $user_id = $_SESSION["loginUser"];

    $queryb = "SELECT book_id FROM book_tb WHERE title = '$title' AND authors = '$author' ";
    $result = query($connection, $queryb);
    while ($row = mysqli_fetch_assoc($result)) {
        $book_id = $row["book_id"];
    }

    $query = $connection->prepare("INSERT INTO book_status_tb (book_id, user_id, borrowed_at, due_back) VALUES (?,?,?,?)");
    $query->bind_param("iiss", $book_id, $user_id, $borrowed_at, $due_back);
    $query->execute();
}
