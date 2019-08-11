<?php
session_start();

$userid=$_SESSION['userid'];

$username=$_SESSION['username'];

if (! $userid) {
    echo "<h3>You are not logged in</h3>\n";
    echo "<h3><a href=login.php>Go to Home page</h3>\n";
    exit;
}

if($username) {
    echo "<h3 style='color: white; margin-left: 10px'>Welcome $username</h3>\n";
    $_SESSION['username'] = NULL;
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

  $action = mysql_real_escape_string($_REQUEST['action']);

  if($action) {
    $countIDSDelete = 0;
    for ($i=0;$i<$num;$i++) {
        $selectedRequest = mysql_real_escape_string($_REQUEST['check' . $i]);
        $selectedQuant = mysql_real_escape_string($_REQUEST['quant' . $i]);
        if(isset($selectedRequest) && isset($selectedQuant)) {
            $deleteQuery = "INSERT INTO cartentries (productid, userid, quantity) VALUES ('$selectedRequest', '$userid', '$selectedQuant')";
            $res2=mysql_query($deleteQuery);
            if (!$res2) {
                echo mysql_error();
                exit;
            }
            $countIDSDelete = $countIDSDelete + 1;
        }
    }
    if ($countIDSDelete > 0) {
    //echo "<h3>The Items've been added to your cart.</h3>\n";
    //sleep(2);
      header('Location: viewCart.php');
      exit;
    }
  }
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Store</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="store.css">
</head>

<body>
    <div id="centerBlock">
        <h2 id="shopHeader" class="card-title">Only Meat - Store</h2>
        <form>
            <table class="striped">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Check to Add</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                        for ($i=0;$i<$num;$i++) {
                            echo "<tr>\n";
                            echo "  <td>" . mysql_result($res,$i,'Name') . "</td>\n";
                            echo "  <td>" . mysql_result($res,$i,'Price') . "</td>\n";
                            echo "  <td>\n" .
                            '<input type="number" name="quant' . $i . '" min="1" max="99" value="1" >' .
                            "</td>\n";
                            echo "  <td>\n" .
                            '<label for="check' . $i . '" onclick="toggleCheck(event)">' .
                            '<input class="filled-in" type="checkbox" name="check' . $i . '" value="' . mysql_result($res,$i,'productid') . '" checked="checked" />' .
                            "<span></span>" .
                            "</label>\n" . 
                            "</td>\n";
                            echo "</tr>\n";
                        }
                    ?>
                </tbody>
            </table>
            <button id="continue" class="btn waves-effect waves-light" type="submit" name="action" value="toCart">
                Add the marked items to the cart
                <i class="material-icons right">send</i>
            </button>
        </form>
            <button id="goBack" class="btn waves-effect waves-light" type="button" onclick="goHome()">
                Log Out
                <i class="material-icons right">send</i>
            </button>
    </div>
    <script src="http://cs.aac.ac.il/~dodstibn/project/store.js"></script>
    <script>
        function goHome() {
            location.replace("http://cs.aac.ac.il/~dodstibn/project/login.php");
        }
    </script>
</body>

</html>