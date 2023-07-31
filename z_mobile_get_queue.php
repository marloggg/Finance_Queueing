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
    $student_id = $_POST['student_id'];
    $customer_name = $student_id;


    $sql2 = "INSERT INTO queue_list (queue, customer_name , `date_created`,student_id) VALUES ('$queue', '$customer_name', datetime('now', '+8 hours'), '$student_id')";
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
