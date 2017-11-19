<?php
require 'db.php';
session_start();
$_SESSION['forgotError'] = "";

//Handle post requests for recovery
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $result = $mysqli->query("SELECT username , email , hashkey FROM monolith_users WHERE email = '$email'");

    //check if email and hash match our db records.
    if ($result->num_rows == 0) {
        $_SESSION['forgotError'] = "The email doesnt exist please try again.";
    } else {
        $user = $result->fetch_assoc();
        $hash = $user['hashkey'];
        $username = $user['username'];
        $to = $user['email'];

        //Build the email to send
        $subject = "Password Link ";
        $message_body = 'Hello' . $username . "." .
            "You have requested to reset your password." .
            "Please click the link below to reset your password" .
            "location: http://" . $_SERVER['HTTP_HOST'] . "/mono/src/reset.php?email=" . $email . "&hash=" . $hash;

        $headers = 'From: Your name <barakMichaeli@domainOnMailServer.com>' . "\r\n";
        $headers .= 'Content-type: text/html;' . "\r\n";

        // info about authentication  - https://stackoverflow.com/questions/10455469/authentication-php-mail
        //In order to send mail we have to use some external php package.
        $message = mail($to, $subject, $message_body, $headers);

        //update the db for not verified mode
        $update = "update monolith_users set verified = 0 where username = '$username' and email= '$to'";

        if ($mysqli->query($update)) {
            $_SESSION['message'] = "Done! Please check your email " . $email .
                " for confirmation link to complete your password reset!";
            //update information
            $mysqli->query("insert into information (username,action) values('$username','FORGET')");
                header("location: http://" . $_SERVER['HTTP_HOST'] . "/mono/src/success.php");
        } else {
            echo "Error updating record: " . $mysqli->error;
        }
    }
}
?>
<html>
<head>
    <title>Forgot password</title>
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
                            <form id="forgot-form" action="" method="post">
                                <h2>Reactive account</h2>
                                <div class="form-group">
                                    <input type="email" name="email" id="email"
                                           class="form-control" placeholder="Email" required>
                                </div>
                                <div class="col-xs-6  form-group">
                                    <input type="submit" name="forgot" id="forgot-submit"
                                           class="form-control btn btn-login" value="SEND EMAIL">
                                </div>
                                <div class="col-xs-6 form-group">
                                    <input type="button" name="back" id="back-login"
                                           class="form-control btn btn-login" value="LOGIN"
                                           onclick=" window.location.href='index.php'">
                                </div>
                            </form>

                            <div class="col-xs-10 ">
                                <p class="h4" id="forgot-msg"> <?php echo $_SESSION['forgotError'] ?></p>
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