
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
    	//fuck I need last contacted date here because otherwise I don't get a 'top' thing without a subselect
    	$newQ = "select el.id from EventListing el ".
    	"left join people p on p.possessingUserId = el.userId ".
		"where el.userId = ".$userId." and p.Id = ".$personId." and TIMESTAMP() >= ".
		"(select contactDate from contactHistory ".
		"where contactHistory.targetPersonId = ".$personId." ".
		"order by contactHistory.id desc limit 1)";

		/*
		$qq = "select el.id, el.userId, el.EventListing from EventListing el
			left join people p on p.possessingUserId = el.userId
				left join lastContacted lc on lc.originelersonId = el.userId
				left join userIntervalLink uil on uil.userId = lc.originPersonId
				left join intervalTypes it on it.id = uil.intervalType
				where el.possessingUserId = ".$userId." and p.id'".$personId."
				and CURRENT_DATE() >= DATE_ADD(lc.lastContactedDate, INTERVAL uil.intervalAmount it.intervalType)";

		$result = mysqli_query($dbhandle, $qq);
		*/
		$result = mysqli_query($dbhandle, $newQ);
		
		$output = array();

		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		    array_push($output, array(recoverString($row['id'])));
		}

		echo json_encode($output);
		function recoverString(string $string) : string{
			return htmlspecialchars_decode($string, ENT_QUOTES);
		}
	}
}
?>