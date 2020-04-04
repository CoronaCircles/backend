<html>
<h1>Welcome</h1>
<p>
  Insert a user name
  
<?php
 require 'functionLibrary.php';
 if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['userName']) && isset($_POST['emailaddress'])) {
    //$result = addNumbers(intval($_POST['number1']), intval($_POST['number2']));
    $result = insertNewUser($_POST['firstName'], $_POST['lastName'], $_POST['userName'], $_POST['emailaddress']);
}
//insertNewUser($firstName, $lastName, $userName, $emailaddress)
//insertNewUser('joe','schmucky','joeboy','joe.schmuck@silly.net');
?>

<form method="post">
First Name: <input type="text" name="firstName"><br>
Last Name: <input type="text" name="lastName"><br>
User Name: <input type="text" name="userName"><br>
E-mail: <input type="text" name="emailaddress"><br>
<input type="submit">
</form>
</p>

</html>
