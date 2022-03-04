<?php
require 'defaultConnector.php';

$userId = "";
$EventTopic = "";
$EventListing = "";

$gets = json_decode(file_get_contents('php://input'), true);

$userId = $gets["userId"];
$EventTopic = $gets["EventTopic"];
$EventListing = $gets["EventListing"];
$sessionId = $gets["sessionID"];




$statement = "select users.user_status from users where users.user_id like $userId and users.sessionID like $sessionId";

//echo json_encode($statement);

$UACresult = mysqli_query($dbhandle, $statement);

$user_access_level = array();

while ($row = mysqli_fetch_array($UACresult, MYSQLI_ASSOC)) {
    array_push($user_access_level,
        array($row['user_status'])
    );
}
//echo json_encode($user_access_level);
$alt = $user_access_level[0];


if ($alt[0] >= 1) {
	//var_dump($gets);

	$diagnosticOut = "";

	$qq = "insert into EventListing(userId, EventTopic, EventListing) values (".$userId.", '".prepString($EventTopic)."', '".prepString($EventListing)."')";

	$result = mysqli_query($dbhandle, $qq);
	$diagnosticOut .= simplog($result, "event insert successful");

	echo json_encode($diagnosticOut);
}

function simplog($result, $call){
	if($result){
		return $call."\n";
	}else{
		return "Could not insert data : " . mysqli_error($dbhandle) . " " . mysqli_errno($dbhandle);
	}
}
function prepString(string $string) : string{
	return htmlspecialchars(str_replace(["\r\n", "\r", "\n"], '<br/>', $string), ENT_QUOTES, "UTF-8");
}


?>