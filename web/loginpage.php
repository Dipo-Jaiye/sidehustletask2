<?php
/*Create an authentication system. Store your data in sessions or cookies variables.*/
session_start();

//Including the database and connecting to it
$servername = "localhost";
$username = "root";
$dbname = "myDB";
$dbpassword = "";
$conn = new mysqli($servername,$username,$dbpassword,$dbname);

if($_SERVER["REQUEST_METHOD"] == "POST"):
    //query db with post params, if found and matched, set session id
    $email = $_POST["user"];
    $pwd = $_POST["userpass"];
    $sql = "SELECT id,password FROM interns WHERE email='$email'";
    $result = $conn->query($sql);
    if($result->num_rows){
        $row = $result->fetch_assoc();
        if($row["password"] == $pwd){
            $_SESSION["id"] = $row["id"];
            $conn->close();
            echo "<h2>Logged in successfully. You will be redirected shortly</h2>";
            header("refresh:5,url=profile.php");
        }
        else{
            echo "<p>The password is incorrect</p>";
            echo "<p><a href=\"mailto:durojaiyep@yahoo.co.uk\">Email</a> the Administrator to reset it</p>";
            echo "<br><a href=".$_SERVER["PHP_SELF"].">Back</a>";
        }
    }
    else{
        echo "No intern registered with that email";
        echo "<br><br><a href=".$_SERVER["PHP_SELF"].">Back</a>";
        echo "<br><br><a href=\"./registrationform.php\">Register</a>";
    };

else:
    echo "Not registered? <a href=\"./registrationform.php\">Register</a>";
?>
<form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
<h4>Login</h4>
<p>Email: <input type="email" name="user" placeholder="email" required></p>
<p>Password: <input type="password" name="userpass" placeholder="password" required></p>

<input type="submit" name="Login"></form>
<?php endif;?>