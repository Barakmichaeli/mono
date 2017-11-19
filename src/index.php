<?php
session_start();
require 'db.php';

//initialize ui variables
$_SESSION['registerError'] = '';
$_SESSION['loginError'] = '';
$_SESSION['loginForm'] = "block";
$_SESSION['regForm'] = "none";

//handle  http post requests from register/login pages
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        require 'login.php';
    } else {
        if (isset($_POST['register'])) {
            require 'register.php';
        }
    }
}
?>

<html>
<head>
    <title>Monolith</title>
    <meta name="author" content="Barak Michaeli">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <script src="script/switchwindows.js"></script>
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
                            <form id="login-form" action="index.php" method="post"
                                  style="display: <?php echo $_SESSION['loginForm'] ?>;">
                                <h2>Login</h2>
                                <div class="form-group">
                                    <input type="text" name="username" id="username" class="form-control"
                                           placeholder="Username" value="" required>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" id="password"
                                           class="form-control" placeholder="Password" required>
                                </div>

                                <div class="col-xs-6 col-xs-offset-3 form-group">
                                    <input type="submit" name="login" id="login-submit"
                                           class="form-control btn btn-login" value="LOG IN">
                                </div>

                                <div class="col-xs-6">
                                    <a href="forgot.php" id="forgot-password">
                                        <div class="login">Forgotten account? Click here!</div>
                                    </a>
                                </div>

                                <div class="col-xs-12">
                                    <p class="h4" id="error-msg"> <?php echo $_SESSION['loginError'] ?></p>
                                </div>
                            </form>

                            <!--  end of login form-->
                            <form id="register-form" action="index.php" method="post" role="form" style="display: <?php echo $_SESSION['regForm'] ?>;">
                                <h2>REGISTER</h2>
                                <div class="form-group">
                                    <input type="text" name="username" id="username" class="form-control"
                                           placeholder="Username" value="" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control"
                                           placeholder="Email Address" value="" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password"
                                           class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm-password" id="confirm-password"
                                           class="form-control" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register" id="register-submit"
                                                   tabindex="4" class="form-control btn btn-register"
                                                   value="Register Now">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-10 ">
                                    <p class="h4" id="error-msg"> <?php echo $_SESSION['registerError'] ?></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-xs-offset-4 tabs">
                    </div>
                </div>

                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6 tabs">
                            <a href="#" class="active" id="login-form-link">
                                <div class="login">LOGIN</div>
                            </a>
                        </div>
                        <div class="col-xs-6 tabs">
                            <a href="#" id="register-form-link">
                                <div class="register">REGISTER</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>