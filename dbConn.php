<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "da-2";

/* Attempt to connect to MySQL database */
$conn = mysqli_connect($servername, $username, $password, $dbname);
 
// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
?>