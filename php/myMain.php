<?php
header("Access-Control-Allow-Origin: *");
require("./config.php");
require("./classes/user.php");



// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }

// $inactive = 60; //1 min
// $session_life = time() - $_SESSION['timeout'];

// if ($session_life > $inactive) {
// session_destroy();
// header("Location: ./login.html");
//     exit();
// }
// $_SESSION['timeout'] = time();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SERVER["PATH_INFO"])) {
        switch ($_SERVER["PATH_INFO"]) {
            case "/register":
                $dbCon = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);
                if (!$dbCon) {
                    die("Connection to the database failed! " . mysqli_connect_error());
                }
                $selectCmd = "SELECT email FROM customer_tb WHERE email='" . $_POST["email"] . "'";
                $result = $dbCon->query($selectCmd);
                if ($result->num_rows > 0) {
                    echo "Failed to register";
                    $dbCon->close();
                } else {
                    $insertCmd = $dbCon->prepare("INSERT INTO customer_tb(fname,lname,email,pass,phone) VALUES (?,?,?,?,?)");
                    $insertCmd->bind_param("sssss", $_POST["fname"], $_POST["lname"], $_POST["email"], password_hash($_POST["pass"], PASSWORD_BCRYPT, ["cost" => 10]), $_POST["phone"]);
                    $insertCmd->execute();
                    echo "Registered successfully";
                    $insertCmd->close();

                    $dbCon->close();
                }
                break;
            case "/reg":
                $dbCon = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);
                if (!$dbCon) {
                    die("Database connection failed. " . mysqli_connect_error());
                }
                $selectCmd = "SELECT email FROM user_tb WHERE email='" . $_POST["email"] . "'";
                $result = $dbCon->query($selectCmd);
                if ($result->num_rows > 0) {
                    echo "Failed to register";
                    $dbCon->close();
                } else {
                    // INSERT INTO `user_tb`(`fname`, `lname`, `email`, `pass`, `phone`, `type`) VALUES ('joao','lamb','joao@mail.com','123','992130827',1);
                    $insertCmd = $dbCon->prepare("INSERT INTO `user_tb`(`fname`, `lname`, `email`, `pass`, `phone`, type) VALUES (?,?,?,?,?,?)");
                    $insertCmd->bind_param("sssssi", $_POST["fname"], $_POST["lname"], $_POST["email"], password_hash($_POST["pass"], PASSWORD_BCRYPT, ["cost" => 10]), $_POST["phone"], $_POST["type"]);
                    $insertCmd->execute();
                    echo "Registered successfully";
                    $insertCmd->close();

                    $dbCon->close();
                }
                break;
            case "/login":
                $email = $_POST["email"];
                $pass = $_POST["pass"];

                $loginUser = null;
                $dbCon = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);
                if (!$dbCon) {
                    die("Connection error " . mysqli_connect_error());
                } else {
                    $selectCmd = "SELECT * FROM customer_tb WHERE email='" . $_POST["email"] . "'";
                    $result = mysqli_query($dbCon, $selectCmd);
                    if (mysqli_num_rows($result) > 0) {
                        $user = mysqli_fetch_assoc($result);
                        $selectUid = "SELECT * FROM blockCus_tb WHERE uid=" . $user["uid"];
                        $uidResult = mysqli_query($dbCon, $selectUid);
                        if (mysqli_num_rows($uidResult) > 0) {
                            $loginUser = 0;
                            $response = array('status' => "Account blocked. Ask João to help you.");
                            echo json_encode($response);
                        } else {
                            if (password_verify($_POST["pass"], $user["pass"])) {
                                if ($user["ecount"] != 5) {
                                    $updateUser = "UPDATE customer_tb SET ecount=5 WHERE uid=" . $user["uid"];
                                    mysqli_query($dbCon, $updateUser);
                                }
                                session_start();
                                session_id();
                                $_SESSION["loginUser"] = $user; //login succes
                                $_SESSION["timeout"] = time() + 60; //store the current timestamp of login
                            } else {
                                $user["ecount"]--;
                                if ($user["ecount"] <= 0) {
                                    $insBlock = "INSERT INTO blockCus_tb (uid) VALUES (" . $user["uid"] . ")";
                                    mysqli_query($dbCon, $insBlock);
                                }
                                $updateUser = "UPDATE customer_tb SET ecount=" . $user["ecount"] . " WHERE uid=" . $user["uid"];
                                mysqli_query($dbCon, $updateUser);
                            }
                        } //PHP_SESSION_ACTIVE is 2 one session exists
                    } //PHP_SESSION_NONE is 1 no session exists
                }
                if (session_status() === PHP_SESSION_ACTIVE) {
                    $_SESSION["uid"] = $user["uid"];
                    $response = array('status' => 'Logged in', 'sessionId' => session_id(), 'uid' => $user["uid"]);
                    echo json_encode($response);
                } elseif ($loginUser === null) {
                    $response = array('status' => 'username/password wrong');
                    echo json_encode($response);
                }

                mysqli_close($dbCon);
                break;

            case "/log":
                $email = $_POST["email"];
                $pass = $_POST["pass"];

                $loginUser = null;
                $dbCon = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);
                if (!$dbCon) {
                    die("Connection error " . mysqli_connect_error());
                } else {
                    $selectCmd = "SELECT * FROM user_tb WHERE email='" . $_POST["email"] . "'";
                    $result = mysqli_query($dbCon, $selectCmd);
                    if (mysqli_num_rows($result) > 0) {
                        $user = mysqli_fetch_assoc($result);
                        $selectUid = "SELECT * FROM block_tb WHERE uid=" . $user["uid"];
                        $uidResult = mysqli_query($dbCon, $selectUid);
                        if (mysqli_num_rows($uidResult) > 0) {
                            $loginUser = 0;
                            $response = array('status' => "Account Blocked, ask Kosuke to help you.");
                            echo json_encode($response);
                        } else {
                            if (password_verify($_POST["pass"], $user["pass"])) {
                                if ($user["ecount"] != 5) {
                                    $updateUser = "UPDATE user_tb SET ecount=5 WHERE uid=" . $user["uid"];
                                    mysqli_query($dbCon, $updateUser);
                                }
                                session_start();
                                session_id();
                                $_SESSION["loginUser"] = $user; //login succes
                                $_SESSION["timeout"] = time() + 60; //store the current timestamp of login
                            } else {
                                $user["ecount"]--;
                                if ($user["ecount"] <= 0) {
                                    $insBlock = "INSERT INTO block_tb (uid) VALUES (" . $user["uid"] . ")";
                                    mysqli_query($dbCon, $insBlock);
                                }
                                $updateUser = "UPDATE user_tb SET ecount=" . $user["ecount"] . " WHERE uid=" . $user["uid"];
                                mysqli_query($dbCon, $updateUser);
                            }
                        } //PHP_SESSION_ACTIVE is 2 one session exists
                    } //PHP_SESSION_NONE is 1 no session exists
                }
                if (session_status() === PHP_SESSION_ACTIVE) {
                    $_SESSION["uid"] = $user["uid"];
                    $response = array('status' => 'Logged in', 'sessionId' => session_id(), 'type' => $user["type"], 'uid' => $user["uid"]);
                    echo json_encode($response);
                } elseif ($loginUser === null) {
                    $response = array('status' => 'username/password wrong');
                    echo json_encode($response);
                }

                mysqli_close($dbCon);
        }
    }
}
