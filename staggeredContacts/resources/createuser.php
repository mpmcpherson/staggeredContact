<?php
include('defaultConnector.php');

$password = "";
$user_name = "";
$email = "";

$gets = json_decode(file_get_contents('php://input'), true);

$user_name = $gets["userName"];
//$userName = $_POST["userName"];
$password = $gets["userPass"];
//$userPass = $_POST["userPass"];

$hash = password_hash($password,  PASSWORD_DEFAULT);

$result = mysqli_query($dbhandle, "INSERT into general_dev_bastion.users(pw_hash, username, email, user_status, organizational_unit) VALUES ('$hash','$user_name','',3, 8)");

?>