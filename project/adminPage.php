<?php 
session_start();
$adminid=$_SESSION['adminid'];

if (! $adminid) {
  echo "<h3>You are not logged in</h3>\n";
  echo "<h3><a href=login.php>Go to Home page</h3>\n";
  exit;
}

if($_SESSION['addItem']) {
    echo "<h3 style='color: white; margin-left: 10px'>The item's been added successfully</h3>\n";
    $_SESSION['addItem'] = NULL;
}

if($_SESSION['deleteItem']) {
    echo "<h3 style='color: white; margin-left: 10px'>The items've been deleted.</h3>\n";
    $_SESSION['deleteItem'] = NULL;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
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
                    <span class="card-title">Only Meat - Admin Page</span>
                    <?php echo "<p>Welcome back, admin" . $_SESSION['adminid'] . ": " . $_SESSION['adminname'] . ".</p>"; ?>
                </div>
                <div class="card-action">
                    <a href="http://cs.aac.ac.il/~dodstibn/project/addItem.php">Add an item</a>
                    <a href="http://cs.aac.ac.il/~dodstibn/project/removeItem.php">Remove items</a>
                    <a href="http://cs.aac.ac.il/~dodstibn/project/complete.php">Complete a transanction</a>
                    <a href="http://cs.aac.ac.il/~dodstibn/project/customers.php">Customers</a>
                    <a href="http://cs.aac.ac.il/~dodstibn/project/products.php">Products</a>
                    <a id="firstLink" href="http://cs.aac.ac.il/~dodstibn/project/login.php">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>