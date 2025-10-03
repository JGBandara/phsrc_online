 <?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname	  = "phsrc_app";


// $servername = "localhost";
// $username = "root";
// $password = "C0w&G@teBa6y";
// $dbname	  = "phsrc_app";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
//mysqli_close($conn);
?> 