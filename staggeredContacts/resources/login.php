<?php
require('PasswordHash.php');
require 'defaultConnector.php';

$userName = "";
$userPass = "";

$gets = json_decode(file_get_contents('php://input'), true);

$userName = $gets["userName"];
$userPass = $gets["userPass"];

$result = mysqli_query($dbhandle,"SELECT pw_hash, user_id from users where username like '$userName'");

$outHash = 'firstassign';
$userid = '';
$resPass = array();
$userIdArr = array();

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    array_push($resPass, $outHash = $row['pw_hash']);
    array_push($userIdArr, $userid = $row['user_id']);
}
$outHash = $resPass[0];
$userid = $userIdArr[0];

$hashing = password_hash($userPass, PASSWORD_DEFAULT);
echo json_encode($hashing,$hashing);

if (strcmp($hashing,$outHash)==0) {
    $rnd=rand();
    $_SESSION['valid'] = 1;
    $_SESSION['userid'] = $userid;
    $_SESSION['username'] = $userName;
    setcookie('userid', $userid, time()+60*60*1, "/");
    setcookie('sessionID', "invalidSessionUnset", time()-(60*60*8), "/");
    setcookie('sessionID', $rnd, time()+60*60*1, "/");
    $newQ = "UPDATE general_dev_bastion.users SET sessionID = ".$rnd." WHERE user_id = '".$_SESSION['userid']."'";
    $result = mysqli_query($dbhandle, $newQ);
    
    echo json_encode(true,$userid,$sessionID); 
} else { 
    echo json_encode([$hashing, $res, null]); 
}
