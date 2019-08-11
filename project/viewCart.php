<?php
session_start();

$userid=$_SESSION['userid'];

if (! $userid) {
    echo "<h3>You are not logged in</h3>\n";
    echo "<h3><a href=login.php>Go to Home page</h3>\n";
    exit;
}
// here is the code that connects to the database. Note that the username
// and password are "hard-coded".

$username="dodstibn"; /* Your MySQL username/password goes here! */
$password="205604481";
$database="dodstibn";

mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

echo "<h3 style='color: white; margin-left: 10px'>Your shopping cart</h3>\n";

// here we define the SQL command
$query = "SELECT * FROM cartentries,products WHERE cartentries.userid=$userid AND cartentries.productid=products.productid";

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
  echo "<h3>Your cart is empty</h3>\n";
  exit;
}

// display everything in the cart as an HTML table
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Complete a transaction</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="store.css">
</head>

<body>
    <div id="centerBlock">
        <h2 id="shopHeader" class="card-title">Only Meat - Cart</h2>
        <table class="striped">
                <thead>
                    <tr>
                      <th>Product</th>
                      <th>Unit Price</th>
                      <th>Quantity</th>
                      <th>Item Total</th>
                    </tr>
                </thead>

                <tbody>
                <?php

                  for ($i=0;$i<$num;$i++) {
                    echo "<tr>\n";
                    echo "  <td>" . mysql_result($res,$i,'Name') . "</td>\n";
                    echo "  <td>" . mysql_result($res,$i,'Price') . "</td>\n";
                    echo "  <td>" . mysql_result($res,$i,'Quantity') . "</td>\n";
                    echo "  <td>" . mysql_result($res,$i,'Quantity') * 
                      mysql_result($res,$i,'Price') . "</td>\n";
                    echo "</tr>\n";
                  }
                  echo "</table>\n";
                ?>
                </tbody>
          </table>
        <button id="continue" class="btn waves-effect waves-light" type="button" onclick="goStore()">
                Go back to the store
                <i class="material-icons right">send</i>
        </button>
    </div>

    <script>
        function goStore() {
            location.replace("http://cs.aac.ac.il/~dodstibn/project/store.php");
        }
    </script>
</body>

</html>
 
