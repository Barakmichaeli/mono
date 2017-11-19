<?php
session_start();
require 'db.php';
$_SESSION['resetError'] = "";

//Check URL parameters
if ((isset($_GET['email']) and !empty($_GET)) and (isset($_GET['hash']) and !empty($_GET['hash']))) {
    $email = $mysqli->escape_string($_GET['email']);
    $preHash = $_GET['hash'];
    $result = $mysqli->query("SELECT * FROM monolith_users where hashkey = '$preHash' and email = '$email' and verified = 0");

    //Check if hash and email match some user
    if ($result->num_rows == 0) {
        header("location: http://" . $_SERVER['HTTP_HOST'] . "/mono/src/index.php");
    } else {
        //post request to reset
        if (isset($_POST['reset'])) {
            if ($_POST['password'] != $_POST['confirm-password']) {
                $_SESSION['resetError'] = "Your passwords do not match";
            } else {
                //Update db
                $newHash = $mysqli->real_escape_string(md5(rand(0, 10000)));
                $escapePassword = $mysqli->real_escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
                $update = "update monolith_users set verified = 1 , hashkey = '$newHash' , pass = '$escapePassword' where hashkey = '$preHash' and email = '$email'";
              
			  if ($mysqli->query($update)) {
                    $_SESSION['message'] = "Done! your password has changed  to" . $_POST['password'] . " please return to login page.";
					$user = $result->fetch_assoc();
					$escapeUsername = $mysqli->real_escape_string($user['username']);
					$mysqli->query("insert into information (username , action) 
								values ('$escapeUsername','RESET')");
		
                    header("location: http://" . $_SERVER['HTTP_HOST'] . "/mono/src/success.php");
                } else {
                    $_SESSION['resetError'] = "Error while resetting your password , please return this link later.";
                }
            }
        }
    }
} else {
            header("location: http://" . $_SERVER['HTTP_HOST'] . "/mono/src/index.php");
}
?>


<html>
<head>
    <title>Resetting account</title>
    <meta name="author" content="Barak Michaeli">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <style>
        body {
            background-image: url("img/nature.jpg");
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="reset-form" action="#" method="post">
                                <h2>Reset your password</h2>

                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2"
                                           class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm-password" id="confirm-password" tabindex="2"
                                           class="form-control" placeholder="Confirm Password">
                                </div>

                                <div class="col-xs-6  form-group">
                                    <input type="submit" name="reset" id="reset"
                                           class="form-control btn btn-login" value="RESET PASSWORDS">
                                </div>

                                <div class="col-xs-6 form-group">
                                    <input type="button" name="back" id="back-login"
                                           class="form-control btn btn-login" value="BACK TO LOGIN"
                                           onclick=" window.location.href='index.php'">
                                </div>
                            </form>

                            <div class="col-xs-10 ">
                                <p class="h4" id="reset-msg"> <?php echo $_SESSION['resetError'] ?></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>