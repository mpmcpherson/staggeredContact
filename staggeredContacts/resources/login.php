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

?>