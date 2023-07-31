<?php

require_once('DBConnection.php');

$code = sprintf("%'.05d",1);
while(true){
    $chk = $conn->query("SELECT count(queue_id) `count` FROM `queue_list` where queue = '".$code."' and date(date_created) = '".date('Y-m-d')."' ")->fetchArray()['count'];
    if($chk > 0){
        $code = sprintf("%'.05d",abs($code) + 1);
    }else{
        break;
    }
}

$_POST['queue'] = $code;
$queue = $_POST['queue'];
$guest_name = $_POST['guest_name'];
$customer_name = $_POST['guest_name'];

$sql1 = "INSERT INTO guest_list (guest_name) VALUES ('$guest_name')";
$conn->exec($sql1);

// get the last inserted guest_id
$guest_id = $conn->lastInsertRowID();

$sql2 = "INSERT INTO queue_list (queue, customer_name , `date_created`,guest_id) VALUES ('$queue', '$customer_name', datetime('now', '+8 hours'), '$guest_id')";
$conn->exec($sql2);

// Create the response array
$response = array(
    "code" => $code,
    "date_created" => date('Y-m-d H:i:s')
);

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

?>