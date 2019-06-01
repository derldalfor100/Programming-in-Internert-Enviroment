<?php 
switch($_SERVER['REQUEST_METHOD'])
{
    case 'GET': $the_request = &$_GET; break;
    case 'POST': $the_request = &$_POST; break;
    default: break;
}
$name = $the_request['name'];
$password = $the_request['pass'];
if(!isset($_COOKIE["username"])) {
    echo "First username Cookie...<br />";
    setcookie('username', $name, time() +86400);
    setcookie('password', $password, time() +86400);
    echo "<button onclick='window.history.back()'>Go Back</button><br />";
    echo "was added!";
} else if($_COOKIE["username"] == $name && $_COOKIE["password"] == $password) {
    // echo "Let's go!";
    header('Location: searches.html');
    exit;
} else if($_COOKIE["username"] != $name) {
    echo "New cookie to change user...<br />";
    setcookie('username', $name, time() +86400);
    setcookie('password', $password, time() +86400);
    echo "<button onclick='window.history.back()'>Go Back</button><br />";
    echo "Added!";
} else {
    echo "Wrong credentials<br />";
    echo "<button onclick='window.history.back()'>Go Back</button>";
}
 ?>
 