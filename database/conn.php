<?php
$dbsvrname = 'localhost';
$dbusrname = 'root';
$dbpass = '';
$dbname = 'db_ewaste';

$conn = new mysqli($dbsvrname, $dbusrname, $dbpass, $dbname);
if ($conn->connect_error) {
    die('connection failed' . $conn->connect_error);
}
