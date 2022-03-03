<?php

include('defaultConnector.php');

$newQ = "UPDATE general_dev_bastion.users SET sessionID = '4' WHERE user_id = '".$_SESSION['userid']."'";
// 1. Find the session
    session_start();

    // 2. Unset all the session variables
    $_SESSION = array();

    // 3. Destroy the session cookie
    if(isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }

    // 4. Destroy the session
    session_destroy();

?>