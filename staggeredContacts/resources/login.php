<?php
require 'defaultConnector.php';

$userName = "";
$userPass = "";

$gets = json_decode(file_get_contents('php://input'), true);

$userName = $gets["userName"];
$userPass = $gets["userPass"];

$qq = "gonna need to actually figure this out. Maybe cannibalize it from elsewhere";

$result = mysqli_query($dbhandle, $qq);


$output = array();

//this will only return userid and the time token
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    array_push($output, array(recoverString($row['id']),recoverString($row['EventTopic'])));
}

echo json_encode($output);


require('PasswordHash.php');
include('defaultConnector.php');


$password = "";

if(!empty($_GET['password']))
{
    $password = $_GET['password'];
}

$user_name = "";

if(!empty($_GET['username']))
{
    $user_name = $_GET['username'];
}

$result = mysqli_query($dbhandle,"SELECT pw_hash, user_id from users where username like '".$user_name."'and status <> -1");


//echo "SELECT pw_hash, user_id, user_status from users where username like '$user_name'";


$outHash = '';
$userid = '';

//echo var_dump($_GET).var_dump($result);

//fetch tha data from the database
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $outHash = $row['pw_hash'];
    $userid = $row['user_id'];
}



$pwdHasher = new PasswordHash(8,false);

if($user_status > -1 && $userNotValid) { //if the user is valid but the session ID is no good
    if ($pwdHasher->CheckPassword($password, $outHash)) { // if the pasword passes...
        $rnd=rand(); //set up a new session, and reset all our cookies to use the new session
        $_SESSION['valid'] = 1;
        $_SESSION['userid'] = $userid;
        $_SESSION['username'] = $user_name;
        setcookie('userid', $userid, time() + 60 * 60 * 1, "/");
        setcookie('sessionID', "invalidSessionUnset", time() - (60 * 60 * 8), "/");
        setcookie('sessionID', $rnd, time() + 60 * 60 * 1, "/");
        $newQ = "UPDATE scrumdb_bastionsoftware.users SET sessionID = ".$rnd." WHERE user_id = '".$_SESSION['userid']."'";
        $result = mysqli_query($dbhandle, $newQ);
        //echo json_encode($rettext);

        echo json_encode("0"); //success

    } else { //user not valid and session ID no good
        echo json_encode("1"); //failure //this should instead start logging things on the back end
    }
}

