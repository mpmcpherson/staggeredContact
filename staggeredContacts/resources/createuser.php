<?php
include('defaultConnector.php');

$password = "";
$user_name = "";
$email = "";

if(!empty($_GET['password'])){
    $password = $_GET['password'];
}
if(!empty($_GET['user_name'])){
    $user_name = $_GET['user_name'];
}
$hash = password_hash($password,  PASSWORD_DEFAULT);

$result = mysqli_query($dbhandle, "INSERT into general_dev_bastion.users(pw_hash, username, email, user_status, organizational_unit) VALUES ('$hash','$user_name','',3, 8)");

?>