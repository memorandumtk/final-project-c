<?php
// 元データ
header("Access-Control-Allow-Origin: *");
require("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SERVER["PATH_INFO"])) {
        switch ($_SERVER["PATH_INFO"]) {
            case "/staff":
                $dbCon = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);
                if (!$dbCon) {
                    die("Connection error " . mysqli_connect_error());
                } else {
                    $selectCmd = "SELECT * FROM staff_db";
                    $result = mysqli_query($dbCon, $selectCmd);

                    $dbData = array();

                    while ($row = mysqli_fetch_assoc($result)) {
                        $dbData[] = $row;
                    }


                    echo json_encode($dbData);
                }

                mysqli_close($dbCon);
                break;

            case "/delete":
                if (isset($_POST["staff_id"])) {
                    $dbCon = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
                    if ($dbCon->connect_error) {
                        echo "DB connection error. " . $dbCon->connect_error;
                    } else {
                        $staffId = $_POST["staff_id"];
                        $delCmd = ("DELETE FROM `staff_db` WHERE staff_id = $staffId");
                        $result = mysqli_query($dbCon, $delCmd);
                       
                        $dbCon->close();
                        echo "this is result of deletion of info of the staff. ";
                        print_r($result);
                    }
                } else {
                    echo "Can not delete since id is not set.";
                }
                break;
        }
    }
}
