<?php
//This is a registration form for an internship
session_start();
echo "<h1>Internship Registration Form</h1>";
echo "Already registered? <a href=\"./loginpage.php\">Login</a>";

//Including the database and connecting to it
$servername = "localhost";
$username = "root";
$dbname = "myDB";
$dbpassword = "";
$conn = new mysqli($servername,$username,$dbpassword,$dbname);

//Defining the error message and form input variables
$fnameErr = $lnameErr = $emailErr = $phoneErr = $trackErr = $userpassErr = "";
$fname = $lname = $email = $phone = $track = $userpass = "";
$trackName = ["front-end"=>"Frontend Web Development","back-end"=>"Backend Web Development","cloud-dev"=>"Cloud Application Development","mobile"=>"Mobile Application Development"];

//Form Validation
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_POST["fname"])){
        $fnameErr = " *required";
    }
    else {
        $fname = clean($_POST["fname"]);
    }
    
    if (empty($_POST["lname"])) {
        $lnameErr = " *required";
    }
    else {
        $lname = clean($_POST["lname"]);
    }
    
    if (empty($_POST["email"])){
        $emailErr = " *required";
    }
    else {
        $email = clean($_POST["email"]);
    }
    
    if (empty($_POST["phone"])) {
        $phoneErr = " *required";
    }
    else {
        $phone = clean($_POST["phone"]);
    }
    
    if (empty($_POST["track"])) {
        $trackErr = " *required";
    }
    else {
        $track = clean($_POST["track"]);
    }

    if (empty($_POST["userpass"])) {
        $userpassErr = " *required";
    }
    else {
        $userpass = clean($_POST["userpass"]);
    }
    
}

//Clean up the form input to remove extra spaces and backslashes
function clean($val){
    $val = trim($val);
    $val = stripslashes($val);
    $val = htmlspecialchars($val);
    return $val;
}

//Display input only after submission if there are no errors
if($_SERVER["REQUEST_METHOD"] == "POST" && empty($fnameErr) && empty($lnameErr) && empty($emailErr) && empty($phoneErr) && empty($trackErr) && empty($userpassErr)):
    //find out if email already exists in database
    $sql = "SELECT email FROM interns WHERE email='$email'";
    $result = $conn->query($sql);
    if($result->num_rows){
        echo "<p>This email is already registered</p>";
        echo "Click <a href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."\">here</a> to go back to the form";
    }
    else{
        $sql = "INSERT INTO Interns(fname, lname, email, phone, track, password) VALUES( '$fname', '$lname', '$email', '$phone', '$trackName[$track]', '$userpass');";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Registration successful. You will be redirected to login page shortly</p><br><br>";
            $conn->close();
            header("refresh:4;url=loginpage.php");
          } else {
            echo "<br><br>Registration error: " . $conn->error;
          }
        }

else:
    //Display the form
    echo "<h4 style=\"color:red\">Fill out all fields</h4>";
?>
<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
    First Name: <input type="text" name="fname" pattern="^[a-zA-Z-']*$" title="Only letters, dashes and apostrophes allowed" value="<?php echo $fname;?>" placeholder="First Name"><span style="color:red"><?php echo $fnameErr;?></span><br><br>

    Last Name: <input type="text" name="lname" pattern="^[a-zA-Z-']*$" title="Only letters, dashes and apostrophes allowed" value="<?php echo $lname;?>" placeholder="Last Name"><span style="color:red"><?php echo $lnameErr;?></span><br><br>

    Email: <input type="email" name="email" value="<?php echo $email;?>" placeholder="Email Address"><span style="color:red"><?php echo $emailErr;?></span><br><br>

    Password: <input type="password" name="userpass" pattern=".{6,12}" title="min 6 max 12" placeholder="Password"><span style="color:red"><?php echo $userpassErr;?></span><br><br>

    Phone Number: <input type="tel" name="phone" pattern="0{1}[0-9]{10}" title="11 digit phone number" value="<?php echo $phone;?>" placeholder="Phone number"><span style="color:red"><?php echo $phoneErr;?></span><br><br>

    Choose your desired track: <br><span style="color:red"><?php echo $trackErr;?></span><br>

    <input type="radio" name="track" value="front-end" <?php if(isset($track) && $track == "front-end")echo "checked";?>>Frontend Web Development<br><br>

    <input type="radio" name="track" value="back-end" <?php if(isset($track) && $track == "back-end")echo "checked";?>>Backend Web Development<br><br>

    <input type="radio" name="track" value="cloud-dev" <?php if(isset($track) && $track == "cloud-dev")echo "checked";?>>Cloud Application Development<br><br>

    <input type="radio" name="track" value="mobile" <?php if(isset($track) && $track == "mobile")echo "checked";?>>Mobile Application Development<br><br>

    <input type="submit" value=" Register "><br><br>
</form>
<?php endif;?>