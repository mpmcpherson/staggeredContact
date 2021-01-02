<?php
require 'defaultConnector.php';

$userId = "";

$gets = json_decode(file_get_contents('php://input'), true);

$userId = $gets["userId"];

$qq = "select el.id, el.userId, el.EventListing from EventListing el
		left join lastContacted lc on lc.originelersonId = el.userId
		left join userIntervalLink uil on uil.userId = lc.originPersonId
		left join intervalTypes it on it.id = uil.intervalType
		where el.possessingUserId = ".$userId."
		and CURRENT_DATE() >= DATE_ADD(lc.lastContactedDate, INTERVAL uil.intervalAmount it.intervalType)";

$result = mysqli_query($dbhandle, $qq);


$output = array();

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    array_push($output, array($row['id'],$row['userId'], $row['EventListing']));
}

echo json_encode($output);

?>