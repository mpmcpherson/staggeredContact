<?php
require 'defaultConnector.php';

$first_name="";
$last_name="";
$userId = "";

$personId="";

$intervalAmount = "";
$intervalType = "";

$channelName = "";
$channelValue = "";

$gets = json_decode(file_get_contents('php://input'), true);

$first_name = $gets["first_name"];
$last_name = $gets["last_name"];
$userId = $gets["userId"];

$intervalAmount = $gets["intervalAmount"];
$intervalType = $gets["intervalType"];

$channelName = $gets["channelName"];
$channelValue = $gets["channelValue"];
$sessionId = $gets["sessionID"];




if(!empty($userId)) {
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

		$diagnosticOut = "";

		//person insert
		$qq = "insert into people(first_name, last_name, possessingUserId) values ('".$first_name."', '".$last_name."', ".$userId.")";
		$result = mysqli_query($dbhandle, $qq);
		$diagnosticOut .= simplog($result, "people insert successful");

		//frequency insert
		$qq = "insert into userIntervalLink(userId, intervalAmount, intervalType) values (".$userId.", ".$intervalAmount.", ".$intervalType.")";
		$result = mysqli_query($dbhandle, $qq);
		$diagnosticOut .= simplog($result, "userIntervalLink insert successful");

		$qq = "select id from people where people.first_name like '%".$first_name."%' and last_name like '%".$last_name."%' and possessingUserId =".$userId." limit 1";
		$result = mysqli_query($dbhandle, $qq);
		$diagnosticOut .= simplog($result, "peopleId select successful");

		$personId = -1;
		if($result){
			$output = array();
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			    array_push($output, array($row['id']));
			}
			$personId = $output[0][0];
		}
		if($personId == -1){
			throw new Exception("didn't get a valid personId after insert");
		}


		$qq = "insert into contactHistory(targetPersonId, originPersonId) values (".$personId.",".$$userId.")";
		$result = mysqli_query($dbhandle, $qq);
		$diagnosticOut .= simplog($result, "successfully set last contact as now");

		//contact details
		$qq = "insert into contactChannels(personId, channelName, channelValue) values (".$personId.", '".$channelName."', '".$channelValue."')";
		$result = mysqli_query($dbhandle, $qq);
		$diagnosticOut .= simplog($result, "contacts insert successful");

		echo json_encode($diagnosticOut);

	}
}

function simplog($result, $call){
	if($result){
		return $call."\n";
	}else{
		return "Could not insert data : " . mysqli_error($dbhandle) . " " . mysqli_errno($dbhandle);
	}
}	

?>