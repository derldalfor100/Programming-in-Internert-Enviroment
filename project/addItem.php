<?php
session_start();
$adminid=$_SESSION['adminid'];

if (! $adminid) {
  echo "<h3>You are not logged in</h3>\n";
  echo "<h3><a href=login.php>Go to Home page</h3>\n";
  exit;
}

// here is the code that connects to the database. Note that the username
// and password are "hard-coded".
$user="dodstibn";
$passwd="205604481";
$database="dodstibn";

$link = mysql_connect(localhost,$user,$passwd);
@mysql_select_db($database) or die( "Unable to select database");

// try to create a new record from the submission
$productName =  mysql_real_escape_string($_REQUEST['productName']);
$price =  mysql_real_escape_string($_REQUEST['price']);

if ($productName && $price) {

  // here we define the SQL command
  $query = "INSERT INTO products SET Name='$productName', Price='$price'";

  // submit the query to the database
  $res=mysql_query($query);

    // make sure it worked!
    if (!$res) {
        echo mysql_error();
        exit;
    }

    $_SESSION['addItem']= TRUE;
    header('Location: adminPage.php');
    exit;
}
?>


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
  <td>Product Name:</td>
  <td><input type=text name="productName"></td>
</tr>

<tr> 
  <td>Price:</td>
  <td><input type="number" name="price" value="50" min="1" max="999"></td>
</tr>

<tr> 
  <td colspan=2>
   <input type=submit value="Add the item">
  </td>
</tr>
</table>
</form>
                </div>
                <div class="card-action">
                    <a id="firstLink" href="http://cs.aac.ac.il/~dodstibn/project/adminPage.php">Admin Page</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


