<?php
$_SESSION['loginError'] = '';

//Get form's data
$username = $_POST['username'];
$pass = $_POST['password'];

//Check if the user already exists.
$result = $mysqli->query("SELECT * FROM monolith_users where username = '$username'");

if ($result->num_rows == 0) {
    $_SESSION['loginError'] = "Could not find your account";
} else {
    $user = $result->fetch_assoc();
    $dbPass = $user['pass'];
    $verified = $user['verified'];
    $email = $user['email'];
    $hash = $user['hashkey'];

    if (!password_verify($pass, $dbPass)) {
        $_SESSION['loginError'] = "Wrong password";
    } else {
        //Right password but in not verified mode - move to reset page
        if ($verified == 0) {
            header("location: http://" . $_SERVER['HTTP_HOST'] . "/mono/src/reset.php?email="
                . $email . "&hash=" . $hash);
        } else {
//            the user verified lets update his cookie and log in
            $cook = $mysqli->real_escape_string(md5(rand(0, 100000)));
            $sql = "update monolith_users set uid='$cook' where username = '$username'";

            if ($mysqli->query($sql)) {
                setcookie("uid", $cook, time() + (86400 * 30), "/"); // 86400 = 1 day
				$escapeUsername = $mysqli->real_escape_string($user['username']);
                $mysqli->query("insert into information (username,action) 
								values ('$escapeUsername','LOGIN')");
            } else {
                echo "Error updating record: " . $mysqli->error;
            }
            header("location: http://" . $_SERVER['HTTP_HOST'] . "/mono/src/profile.php");
        }
    }
}





