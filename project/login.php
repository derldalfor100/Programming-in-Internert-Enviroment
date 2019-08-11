<?php
session_start();

$userid=$_SESSION['userid'];
$adminid=$_SESSION['adminid'];

if ($userid) {
    $_SESSION['userid'] = NULL;
}

if ($adminid) {
    $_SESSION['adminid'] = NULL;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main Page</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <div id="menuContainer" class="row">
        <div class="col s12 l6">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <span class="card-title">Only Meat</span>
                    <p>Hi, welcome to my store! No entrance for vegetarians... The best place for the new weirdos.</p>
                </div>
                <div class="card-action">
                    <a id="firstLink" href="http://cs.aac.ac.il/~dodstibn/project/adminLogin.php">Admin Log in</a>
                    <a href="http://cs.aac.ac.il/~dodstibn/project/loginCart.php">Log In</a>
                    <a href="http://cs.aac.ac.il/~dodstibn/project/createUser.php">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>