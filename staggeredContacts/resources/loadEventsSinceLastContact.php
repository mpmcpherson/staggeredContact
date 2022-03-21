
<?php
require 'defaultConnector.php';

$userId = "";
$personId="";

$gets = json_decode(file_get_contents('php://input'), true);

$userId = $gets["userId"];
$personId = $gets["personId"];
$sessionId = $gets["sessionID"];




if(!empty($userId)) {
    $statement = "select users.user_status from users where users.user_id like $userId  and users.sessionID like $sessionId";
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
    	
    	$newQ = "select el.id from EventListing el left join people p on p.possessingUserId = el.userId where el.userId = ".$userId." and p.Id = ".$personId." and EventListing.dateCreated >= (select contactDate from contactHistory where contactHistory.targetPersonId = ".$personId." order by contactHistory.id desc limit 1)";
		$result = mysqli_query($dbhandle, $newQ);
		
		$output = array();

		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		    array_push($output, array(recoverString($row['id'])));
		}

		echo json_encode($output);

	}
}
function recoverString(string $string) : string{
	return htmlspecialchars_decode($string, ENT_QUOTES);
}
?>