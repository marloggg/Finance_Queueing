<?php
require_once('DBConnection.php');

// Query your database table to retrieve the start and end time values
$query = "SELECT default_start_time, default_cutoff_time, manual_cutoff_time FROM queuing_start_end";
$result = $conn->query($query);
$row = $result->fetchArray(SQLITE3_ASSOC);

$startTime =date("H:i", strtotime($row['default_start_time']));
$cutoffTime = date("H:i", strtotime($row['default_cutoff_time']));
$manualCutoffTime = $row['manual_cutoff_time'];


$currentTime = time();
$date = date("H:i", $currentTime);
//echo "Start Time: $date";

if ($manualCutoffTime == 0) {
    if ($date >= $startTime && $date <= $cutoffTime) {
        echo 'true';
    } else {
        echo 'false';
    }
} else {
    echo 'false';
}
?>