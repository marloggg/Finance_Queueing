<?php
require_once('DBConnection.php');

if(isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];
    

    $sql = "SELECT * FROM `student_list` WHERE `student_id` = '$student_id'";
    $chk = $conn->query($sql);
    
    if($chk->fetchArray()) {
        echo "true";
    } else { 
        echo "false";
    }
}
?>