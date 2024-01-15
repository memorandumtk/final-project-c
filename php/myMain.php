<?php
header("Access-Control-Allow-Origin: *");
require("./config.php");
require ("./class/user.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SERVER["PATH_INFO"])){
        switch($_SERVER["PATH_INFO"]){
            case "/register":
                $dbCon = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);
                if(!$dbCon){
                    die ("Connection to the database failed! ".mysqli_connect_error());
                }
                $selectCmd = "SELECT email FROM customer_tb WHERE email='".$_POST["email"]."'";
                $result = $dbCon->query($selectCmd);
                if($result->num_rows > 0){
                    echo "Failed to register";
                    $dbCon->close();
                }else{
                    $insertCmd = $dbCon->prepare("INSERT INTO customer_tb(fname,lname,email,pass,phone) VALUES (?,?,?,?,?)");
                    $insertCmd->bind_param("sssss",$_POST["fname"],$_POST["lname"],$_POST["email"],password_hash($_POST["pass"],PASSWORD_BCRYPT,["cost"=>10]),$_POST["phone"]);
                    $insertCmd->execute();
                    print_r($_POST);
                    echo "Registered successfully";
                    $insertCmd->close();

                    $dbCon->close();
                }
                break;
                case "/reg":
                    $dbCon = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);
                    if(!$dbCon){
                        die ("Database connection failed. ".mysqli_connect_error());
                    }
                $selectCmd = "SELECT email FROM user_tb WHERE email='" . $_POST["email"] . "'";
                $result = $dbCon->query($selectCmd);
                if ($result->num_rows > 0) {
                    echo "Failed to register";
                    $dbCon->close();
                }else{
                    // INSERT INTO `user_tb`(`fname`, `lname`, `email`, `pass`, `phone`, `type`) VALUES ('joao','lamb','joao@mail.com','123','992130827',1);
                    $insertCmd = $dbCon->prepare("INSERT INTO `user_tb`(`fname`, `lname`, `email`, `pass`, `phone`, type) VALUES (?,?,?,?,?,?)");
                    $insertCmd->bind_param("sssssi",$_POST["fname"], $_POST["lname"], $_POST["email"], password_hash($_POST["pass"], PASSWORD_BCRYPT, ["cost" => 10]), $_POST["phone"],$_POST["type"]);
                    $insertCmd->execute();
                    print_r($_POST);
                    echo "Registered successfully";
                    $insertCmd->close();

                    $dbCon->close();

                }
                break;
                case "/loginC":
                $login = false;
                $dbCon = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);
                if (!$dbCon) {
                    die("Connection to the database failed! " . mysqli_connect_error());
                }else{
                    $selectCmd = "SELECT * FROM customer_tb WHERE email = ? AND pass = ?";
                    $stmt = $dbCon->prepare($selectCmd);
                    $stmt->bind_param("ss", $email, $pass);

                    $stmt->execute();
                    $result = $stmt->get_result();

                    if($result->num_rows>0){
                        $user = $result->fetch_assoc();

                        session_start();
                        $response = ["sid"=>session_id(), "user"=>$user];
                        $login = true;
                        echo json_encode($response);
                    }else{
                        echo 'Invalid username or password';
                    }
                    $stmt->close();
                    $dbCon->close();
                }
                if($login)
                    http_response_code(200);
                else
                    http_response_code(401);
                break;
            }
        }
    }

?>