<?php
// Database credentials
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'final_db';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>