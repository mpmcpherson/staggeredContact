<?php
require 'defaultConnector.php';

$userId = "";

$gets = json_decode(file_get_contents('php://input'), true);

$userId = $gets["userId"];
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
        $qq = "select * from people where people.possessingUserId = ".$userId;

        $result = mysqli_query($dbhandle, $qq);


        $output = array();

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            array_push($output, array($row['id'],$row['first_name'], $row['last_name'], $row['possessingUserId']));
        }

        echo json_encode($output);
    }
}
?>