<?php
require 'defaultConnector.php';

$userId = "";

$gets = json_decode(file_get_contents('php://input'), true);

$userId = $gets["userId"];
$sessionId = $gets["sessionID"];




$statement = "select user_status from general_dev_bastion.users where user_id = ".$userId." and users.sessionID = ".$sessionId;
//echo json_encode("statement: ".$statement);
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
	$qq = "select * from EventListing el where el.userId = ".$userId." order by id desc";

	$result = mysqli_query($dbhandle, $qq);


	$output = array();

	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	    array_push($output, array(recoverString($row['id']),recoverString($row['EventTopic'])));
	}

	echo json_encode($output);

}else{
	echo json_encode(["error","error"]);
}

function recoverString(string $string) : string{
	return htmlspecialchars_decode($string, ENT_QUOTES);
}
?>