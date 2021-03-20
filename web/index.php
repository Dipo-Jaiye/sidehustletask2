<?php
session_start();
echo "<h1>Welcome to SideHustle Internship</h1>";

//if already logged in, go to profile or log out
if(!empty($_SESSION["id"])){
    echo "<p><a href=\"./profile.php\">Profile</a></p>";
    echo "<p><a href=\"./logout.php\">Log out</a></p>";}

//if not logged in, register or log in
else{
    echo "<p><a href=\"./registrationform.php\">Register</a></p>";
    echo "<p><a href=\"./loginpage.php\">Login</a></p>";
}
?>