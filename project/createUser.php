<?php

// here is the code that connects to the database. Note that the username
// and password are "hard-coded".

$username="dodstibn"; /* Your MySQL username/password goes here! */
$password="205604481";
$database="dodstibn";

@mysql_connect(localhost,$username,$password) or die( "Unable to connect");
@mysql_select_db($database) or die( "Unable to select database");

// try to create a new record from the submission
$firstname = mysql_real_escape_string($_REQUEST['firstname']);
$lastname =  mysql_real_escape_string($_REQUEST['lastname']);
$username =  mysql_real_escape_string($_REQUEST['username']);
$password= mysql_real_escape_string($_REQUEST['password']);

if ($firstname && $lastname && $username && $password) {

  // here we define the SQL command
  $query = "SELECT * FROM people WHERE Username='$username'";

  // submit the query to the database
  $res=mysql_query($query);

  // make sure it worked!
  if (!$res) {
	mysql_error();
	exit;
  }

  // find out how many records we got
  $num = mysql_numrows($res);
  if ($num>0) {
	echo "<h3>That username is already taken</h3>\n";
	exit;
  }

  // Create the record
  $query = "INSERT INTO people SET FirstName='$firstname', LastName='$lastname', Username='$username', Password='$password'";
  $res = mysql_query($query);
  if (! $res) {
	echo mysql_error();
	exit;
  } else {
	echo "<h3>Account Created</h3>\n";
  $_SESSION['username']=$username;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
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
                    <span class="card-title">Sign Up</span>
                    <form>
<table class="striped">
<tr> 
  <td>First Name:</td>
  <td><input type=text name=firstname></td>
</tr>

<tr> 
  <td>Last Name:</td>
  <td><input type=text name=lastname></td>
</tr>

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
   <input type=submit value="Create my account">
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

 
