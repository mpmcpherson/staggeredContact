<?php
require 'defaultConnector.php';

$first_name="";
$last_name="";
$userId = "";

$intervalAmount = "";
$intervalTime = "";
$intervalType = "";

$personId = "";
$channelName = "";
$channelValue = "";

$gets = json_decode(file_get_contents('php://input'), true);

$first_name = $gets["first_name"];
$last_name = $gets["last_name"];
$userId = $gets["userId"];

$intervalAmount = $gets["intervalAmount"];
$intervalTime = $gets["intervalTime"];
$intervalType = $gets["intervalType"];

$personId = $gets["personId"];
$channelName = $gets["channelName"];
$channelValue = $gets["channelValue"];

var_dump($gets);

//person insert
$qq = "insert into person(first_name, last_name, possessingUserId) values (".$first_name.", ".$last_name.", ".$userId.")";
$result = mysqli_query($dbhandle, $qq);

//frequency insert
$qq = "insert into unserIntervalLInk(userId, intervalAmount, intervalType) values (".$userId.", ".$intervalAmount.", ".$intervalType.")";
$result = mysqli_query($dbhandle, $qq);

//going to have to select newest to get personid
//contact details
$qq = "insert into contactChannels(personId, channelName, channelValue) values (".$personId.", ".$channelName.", ".$channelValue.")";
$result = mysqli_query($dbhandle, $qq);

echo json_encode("inserts successful");
?>