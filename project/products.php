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



  // here we define the SQL command
  $query = "SELECT * FROM products";

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
	echo "<h3>No Products.</h3>\n";
	exit;
  }
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="store.css">
</head>

<body>
    <div id="centerBlock">
        <h2 id="shopHeader" class="card-title">Products</h2>
            <table class="striped">
                <thead>
                    <tr>
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Unit Price</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                        for ($i=0;$i<$num;$i++) {
                            echo "<tr>\n";
                            echo "  <td>" . mysql_result($res,$i,'productid') . "</td>\n";
                            echo "  <td>" . mysql_result($res,$i,'Name') . "</td>\n";
                            echo "  <td>" . mysql_result($res,$i,'Price') . "</td>\n";
                            echo "</tr>\n";
                        }
                    ?>
                </tbody>
            </table>
            <button id="continue" class="btn waves-effect waves-light" type="button" onclick="goMenu()">
                Back to the Main Page
                <i class="material-icons right">send</i>
            </button>
    </div>
    <script>
        function goMenu() {
            location.replace("http://cs.aac.ac.il/~dodstibn/project/adminPage.php");
        }
    </script>
</body>

</html>