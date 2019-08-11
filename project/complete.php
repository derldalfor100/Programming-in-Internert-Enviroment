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

$username="dodstibn"; /* Your MySQL username/password goes here! */
$password="205604481";
$database="dodstibn";

mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

// here we define the SQL command
$query = "SELECT DISTINCT userid FROM cartentries,products WHERE cartentries.productid=products.productid";

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
  echo "<h3>No transactions left to complete.</h3>\n";
  exit;
}

$action =  mysql_real_escape_string($_REQUEST['action']);
$selectComplete = mysql_real_escape_string($_REQUEST['selectComplete']);

if($action && isset($selectComplete)) {
            $queryAction = "DELETE FROM cartentries WHERE cartentries.userid='$selectComplete'";
            $resAction=mysql_query($queryAction);

            // make sure it worked!
            if (!$resAction) {
              echo mysql_error();
              exit;
            }

            echo '<h3 style="margin-left: 1vw; color: white;">' . "The transaction's been completed.</h3>\n";
            echo '<button style="margin-left: 1vw;" class="btn waves-effect waves-light" type="button" onclick="goMenu()">' .
            'Go back to the main page' .
            '<i class="material-icons right">send</i>' .
            '</button>';
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
        <h2 id="shopHeader" class="card-title">Only Meat</h2>
        <form>
        <div class="input-field col s12">
          <label style="top: -1.75rem;">   Select a user to complete his transaction</label>
            <select name="selectComplete" autofocus style="position:relative; display: inline-block; top: 0.75rem;">
                  <?php
                    for ($i=0;$i<$num;$i++) {
                      $theUserID =  mysql_result($res,$i,'userid');
                      $querySelect = "SELECT UserName FROM people WHERE people.userid='$theUserID'";
                      $resSelect = mysql_query($querySelect);
                      // make sure it worked!
                      if (!$resSelect) {
                        echo mysql_error();
                        exit;
                      }
                      echo "  <option value='" . mysql_result($res,$i,'userid') . "'>" . mysql_result($resSelect,0,'UserName') . "</option>\n";
                    }
                  ?>
            </select>
        </div>
            <button id="continue" class="btn waves-effect waves-light" type="submit" name="action" value="complete a transaction">
                Delete to complete the transaction
                <i class="material-icons right">send</i>
            </button>
        </form>
        <button id="goBack" class="btn waves-effect waves-light" type="button" onclick="goMenu()">
                Go back to the main page
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