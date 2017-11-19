<?php
$_SESSION['registerError'] = '';

//Prevent random accesses
if (!isset($_POST['register'])) {
    exit();
}
//control ui elements
$_SESSION['loginForm'] = "none";
$_SESSION['regForm'] = "block";

if ($_POST['password'] != $_POST['confirm-password']) {
    $_SESSION['registerError'] = "Your passwords do not match";
} else {
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];

//Encode data for db
    $escapeEmail = $mysqli->real_escape_string($_SESSION['email']);
    $escapeUsername = $mysqli->real_escape_string($_SESSION['username']);
    $escapePassword = $mysqli->real_escape_string(password_hash($_SESSION['password'], PASSWORD_BCRYPT));
    $cook = $mysqli->real_escape_string(md5(rand(0, 100000)));
    $verified = 1;
    $hash = $mysqli->real_escape_string(md5(rand(0, 10000)));

//Check if the username already exists or if email is already exists
    $result = $mysqli->query("SELECT * FROM monolith_users WHERE email = '$escapeEmail' or username = '$escapeUsername'");
    if ($result->num_rows > 0) {
        //user already exists
        $user = $result->fetch_assoc();
        $username = $user['username'];
        if (!empty($username) and $username == $_SESSION['username']) {
            $_SESSION['registerError'] = "This username is already taken";
        } else {
            $_SESSION['registerError'] = "This email is already in use";
        }
    } else {

        //The user doesnt exists - add him
        $update = "insert into monolith_users (username,email,pass,uid,hashkey)
                    values ('$escapeUsername' , '$escapeEmail', '$escapePassword', '$cook' ,'$hash') ";
        
        if ($mysqli->query($update) === TRUE) {
            //Inserted successfully
            $_SESSION['loggedin'] = true;
            setcookie("uid", $cook, time() + (86400 * 30), "/"); // 1 day
			$mysqli->query("insert into information (username,action) 
						    values ('$escapeUsername','REGISTER')");
            header("location: http://" . $_SERVER['HTTP_HOST'] . "/mono/src/profile.php");
        } else {
            //Error while inserting
            $_SESSION['registerError'] = "There was an error while registering the user" .
                " please try again :(";
        }
    }
}


