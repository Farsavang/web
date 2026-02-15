<?php
$dbhostname = 'localhost'; // hostname ຫ ຼື IP ຂອງ Database Server
$dbusername = 'root'; // username ຂອງ Database
$dbpassword = '';
$dbname = 'web'; // ຊຼືື່ຂອງ Database (schema)
$conn = new mysqli($dbhostname, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}