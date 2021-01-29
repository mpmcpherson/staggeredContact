<?php
require('PasswordHash.php');
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
if(!empty($_GET['email'])){
    $email = $_GET['email'];
}

$pwdHasher = new PasswordHash(8, FALSE);

$hash = $pwdHasher->HashPassword($password);

$result = mysqli_query($dbhandle, "INSERT into users(pw_hash, username, email, user_status, organizational_unit) VALUES ('$hash','$user_name','$email',3, 8)");

$newUser = mysqli_query($dbhandle, "select user_id from users where user_name like $user_name");

$ary = array();

while($row = mysqli_fetch_array($newUser, MYSQLI_ASSOC))
{
    array_push($ary, array($row['user_id']));
}
?>