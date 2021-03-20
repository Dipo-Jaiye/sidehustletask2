<?php
session_start();

//Including the database and connecting to it
$servername = "localhost";
$username = "root";
$dbname = "myDB";
$dbpassword = "";
$conn = new mysqli($servername,$username,$dbpassword,$dbname);

//Find the user from the database using their uniqie id
$sql = "SELECT * FROM interns WHERE id=".$_SESSION["id"].";";
$result = $conn->query($sql);
if($result->num_rows){
    $row = $result->fetch_assoc();
    $fname = $row["fname"];
    $lname = $row["lname"];
    $phone = $row["phone"];
    $track = $row["track"];
    echo "<h1>Sidehustle Internship</h1>";
    echo "<p>Welcome $fname $lname</p>";
    echo "<p>Phone number: $phone</p>";
    echo "<p>Track: $track</p>";
    echo "<br>";
    echo "<p><a href=\"./update.php\">Edit Profile</a></p>";
    echo "<p><a href=\"./logout.php\">Log out</a></p>";
}
else{
    echo "<strong>Error retrieving details</strong>";
    echo "<p>Please log in again <a href=\"./loginpage.php\">login</a></p>";
}

?>