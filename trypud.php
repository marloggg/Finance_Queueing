<?php 
require_once('DBConnection.php');

  
  
    $chk = $conn->query("SELECT `queue` FROM `queue_list` where queue_id = (SELECT MAX(queue_id) FROM `queue_list` WHERE status = 1)AND status = 1");
   
    $count = 0;
    while ($row = $chk->fetchArray()) {
      $count++;
      echo "" . $row['queue'];
    }
    
   
    
?>
