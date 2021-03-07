<?php
/*Create an authentication system. Store your data in sessions or cookies variables.*/
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"):
    if($_POST["user"] == $_COOKIE["email"] && $_POST["phone"] == $_COOKIE["phone"]){
        echo "<h2>Welcome ".$_COOKIE["name"]."</h2>";
        echo "<a href=\"./web/index.php\">Home</a>";
        $_SESSION["name"]=$_COOKIE["name"];
        $_SESSION["track"]=$_COOKIE["track"];};

else:
    echo "Not registered? <a href=\"./web/registrationform.php\">Register</a>";
?>
<form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
<table>
<th colspan=2>Login<th>
<tr><td>Username: </td><td><input type="email" name="user" placeholder="email" required></td></tr>
<tr><td>Phone: </td><td><input type="tel" name="phone" placeholder="phone number" required></td></tr>
</table>
<input type="submit" name="Login"></form>
<?php endif;?>