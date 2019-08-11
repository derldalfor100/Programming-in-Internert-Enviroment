<?php
session_start();

// here is the code that connects to the database. Note that the username
// and password are "hard-coded".
$user="dodstibn";
$passwd="205604481";
$database="dodstibn";

$link = mysql_connect(localhost,$user,$passwd);
@mysql_select_db($database) or die( "Unable to select database");

// try to create a new record from the submission
$username =  mysql_real_escape_string($_REQUEST['username']);
$password= mysql_real_escape_string($_REQUEST['password']);

if ($username && $password) {

  // here we define the SQL command
  $query = "SELECT * FROM admin WHERE Username='$username' AND Password='$password'";

  // submit the query to the database
  $res=mysql_query($query);

  // make sure it worked!
  if (!$res) {
	echo mysql_error();
	exit;
  }

  // find out how many records we got
  $num = mysql_numrows($res);
  if ($num==0) {
	echo "<h3>Invalid login</h3>\n";
	exit;
  } elseif ($num!=1) {
	echo "<h3>Error - unexpected result!\n";
	exit;
  }

  // valid login, set the session variable
  $_SESSION['adminid']=mysql_result($res,0,'userid');
  $_SESSION['adminname']=$username;
  header('Location: adminPage.php');
  // echo "user id: " . $_SESSION['userid'];
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>
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
                    <span class="card-title">Sign In</span>
                    <form>
<table class="striped">
<tr> 
  <td>Username:</td>
  <td><input type=text name=username></td>
</tr>

<tr> 
  <td>Password:</td>
  <td><input type=password name=password></td>
</tr>

<tr> 
  <td colspan=2>
   <input type=submit value="Login">
  </td>
</tr>
</table>
</form>
                </div>
                <div class="card-action">
                    <a id="firstLink" href="http://cs.aac.ac.il/~dodstibn/project/login.php">Home Page</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

