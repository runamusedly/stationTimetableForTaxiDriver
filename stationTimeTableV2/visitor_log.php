<?php
function visitor_log() {
// Get the visitor's IP address
$ip_address = $_SERVER['REMOTE_ADDR'];

// Get the current date and time
$date_time = date('Y-m-d H:i:s');

// Get the page the visitor is accessing
$page = $_SERVER['REQUEST_URI'];

// Create a log entry
$log_entry = "IP: $ip_address - Date/Time: $date_time - Page: $page\n";

// Specify the log file path
$log_file = 'visitor_log.txt';

// Append the log entry to the log file
file_put_contents($log_file, $log_entry, FILE_APPEND);
}
echo "Visitor information logged successfully.";
?>
