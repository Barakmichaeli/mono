<?php
session_start();
require 'db.php';

if (!isset($_COOKIE["uid"])) {
    //No cookie at all
    $_SESSION['title'] = "Link broken!";
    $_SESSION['body'] = "You are trying to access a private area <br> please see the link below";
    $_SESSION['link'] = "http://" . $_SERVER['HTTP_HOST'] . "/mono/src/index.php";
    $_SESSION['button'] = "Login";

} else {
//Check if this cookie exists in db
    $cook = $_COOKIE['uid'];
    $result = $mysqli->query("SELECT * FROM monolith_users where uid = '$cook'");

    if ($result->num_rows == 0) {
        //Case the cookie is fake
        $_SESSION['title'] = "Link broken!";
        $_SESSION['body'] = "Warning! trying to hack our server , please follow the link below and next time trust the developer ;) .";
        $_SESSION['link'] = "http://" . $_SERVER['HTTP_HOST'] . "/mono/src/index.php";
        $_SESSION['button'] = "Login";
    } else {
        $_SESSION['active'] = true;
        $user = $result->fetch_assoc();
        $email = $user['email'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['title'] = "Welcome " .$_SESSION['username'];
        $_SESSION['body'] = "Did you know ? monolith is a geological feature consisting of a single massive stone or rock, such as some mountains, or a single large piece of rock placed as, or within, a monument or building.";
        $_SESSION['link'] = "http://" . $_SERVER['HTTP_HOST'] . "/mono/src/logout.php";
        $_SESSION['button'] = "Logout";
    }
}
?>

<html>
<head>
    <title>Profile</title>
    <meta name="author" content="Barak Michaeli">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <style>
        body {
            background-image: url("img/monilithPic.jpg");
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
                            <div class="jumbotron" style="text-align: center; margin-bottom: 0px">
                                <?php
                                echo "<h2 class='display-3'>" . $_SESSION['title'] . "</h2>";
                                echo "<p class='lead'>" . $_SESSION['body'] . "</p>";
                                ?>
                                <p><a id="btn" class="btn btn-lg btn-success" href="<?php echo $_SESSION['link'] ?>"
                                      role="button"
                                      onClick="document.location.href='index.php"
                                    ><?php echo $_SESSION['button'] ?></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>