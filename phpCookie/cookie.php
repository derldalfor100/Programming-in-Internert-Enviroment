<?php 
switch($_SERVER['REQUEST_METHOD'])
{
    case 'GET': $the_request = &$_GET; break;
    case 'POST': $the_request = &$_POST; break;
    default: break;
}
if($the_request['guessnumber'] == 5){
    echo "<p>You've guessed correctly. The number is " . $the_request['guessnumber'] . "</p>";
} else {
    echo '<link rel="stylesheet" type="text/css" href="style.css" />';
    echo '<form action="cookie.php" method="get">';
    echo '<label for="guessnumber">Guess a number between 1 to 10:</label>';
    echo '<input required type="text" name="guessnumber" id="guessnumber" placeholder="5" size="2" minlength="1" maxlength="2" />';
    echo '<br />';
    echo '<input type="submit" onclick="validate(event)">';
    echo '<br />';
    echo '<p id="err"></p>';
    echo '</form>';
    echo '<script src="script.js"></script>';
}
 ?>
 