<?php

include('defaultConnector.php');

$newQ = "UPDATE general_dev_bastion.users SET sessionID = '4' WHERE user_id = '".$_SESSION['userid']."'";
$result = mysqli_query($dbhandle, $newQ);
session_start();

$_SESSION = array();

setcookie('userid', "", time() - 60 * 60 * 1, "/");
setcookie('sessionID', "", time() - (60 * 60 * 8), "/");
setcookie('sessionID', $rnd, time() - 60 * 60 * 1, "/");


unset($_COOKIE['PHPSESSID']);

session_destroy();

?>