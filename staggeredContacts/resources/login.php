<?php

require 'defaultConnector.php';

$userName = "";
$userPass = "";

$gets = json_decode(file_get_contents('php://input'), true);

$userName = $gets["userName"];
//$userName = $_POST["userName"];
$userPass = $gets["userPass"];
//$userPass = $_POST["userPass"];



$result = mysqli_query($dbhandle,"SELECT pw_hash, user_id from general_dev_bastion.users where username like '$userName'");

$userid = '';
$resPass = array();
$userIdArr = array();

session_start();

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    array_push($resPass, $row['pw_hash']);
    array_push($userIdArr, $row['user_id']);
}

$userid = $userIdArr[0];

if (password_verify($userPass, $resPass[0])) {
    $rnd=rand();
    $sessionID = $rnd;
    $_SESSION['valid'] = 1;
    $_SESSION['userid'] = $userid;
    $_SESSION['username'] = $userName;



    setcookie('userid', $userid,  [
    'expires' => time()+60*60*1,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true,
    'httponly' => false,
    'samesite' => 'None',
    ]);

    setcookie('sessionID', "invalidSessionUnset",  [
    'expires' => time()+60*60*1,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true,
    'httponly' => false,
    'samesite' => 'None',
    ]);
    
    setcookie('sessionID', $rnd,  [
    'expires' => time()+60*60*1,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true,
    'httponly' => false,
    'samesite' => 'None',
    ]);
    
    $newQ = "UPDATE general_dev_bastion.users SET sessionID = ".$sessionID." WHERE user_id = '".$_SESSION['userid']."'";

    $result = mysqli_query($dbhandle, $newQ);
    
    echo json_encode([true,$userid,$sessionID]);
} else { 
    echo json_encode([false, $userName, $userPass]);
}
