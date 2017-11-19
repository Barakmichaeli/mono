<?php
session_start();
?>

<html>
<head>
    <title>Success Page</title>
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
                            <h2>Done!</h2>

                            <div class="col-xs-12 success-msg">
                                <p class="h4"> <?php
                                    if (isset($_SESSION['message']) AND !empty($_SESSION['message'])) {
                                        echo $_SESSION['message'];
                                    } else {
                                        header("location: http://" . $_SERVER['HTTP_HOST'] . "/mono/src/index.php");
                                    }
                                    ?></p>
                            </div>
                            <div class="col-xs-6 col-xs-offset-3">
                                <a href="index.php" id="forgot-password" style="text-decoration: none">
                                    <button type="button" class="btn btn-lg btn-primary btn-block">BACK TO LOGIN
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
