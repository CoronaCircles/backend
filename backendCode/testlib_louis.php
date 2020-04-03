<html>
<h1>Welcome</h1>
<p>
  Insert : Louis COOOOdsdOOOOO lord louis@poncet.org
</p>
<?php
echo "<p>before require</p>";

//require 'config.php';
require 'functionLibrary.php';
echo "<p>after require</p>";

/*

$conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
    // $sql = "INSERT INTO USER(FIRSTNAME, LASTNAME, DISPLAYNAME, EMAILADDRESS)
    // VALUES ($firstName, $lastName, $userName, $emailaddress)";

    insertNewUser('joe','schmucky','joeboy','joe.schmuck@silly.net');  $city = $mysqli->real_escape_string($city);
*/

$firstName="Louis";
$lastName="COOOOdsdOOOOO";
$displayName = "lord";
$emailaddress="louis@poncet.org";
$circleName="Best Tartiflette";
$circleID = 7;
$userID = 19;
?>
<p>Before insertNewUser</p>
<?php
// get the userId
$userReturn=insertNewUser($firstName, $lastName, $displayName,$emailaddress);
printf ("<p>-- New Record has id %d.\n</p>", $userReturn);
?>
<p>After insertNewUser</p>
<p>Before insertNewCircle</p>
<?php
// function insertNewCircle($circleName, $description, $frequency, $url)
// get the CircleId
$circleReturn = insertNewCircle("Best Tartiflette","The place to be if you love Tartiflette","onetime","https://meet.jit.si/tartiflette");
printf ("<p>-- New Record has id %d.\n</p>", $circleReturn);

?>
  <p>After insertNewCircle</p>
  <p>Before addNewUserToCircle</p>
<?php

// function addNewUserToCircle($circleID, $userID)
$UserReturn = addNewUserToCircle($circleID,$userID);
printf ("<p>-- New Record has id %d.\n</p>", $UserReturnn);

?>
  <p>Before findCircleIDbyName</p>
<?php
$circleID = 7;
$userID = 19;
// addNewHostToCircle($circleID, $userID);
$circleIdentity=findCircleIDbyName("rumpus");
printf ("<p>-- New Record has id %d.\n</p>", $circleIdentity);

?>
  <p>After findCircleIDbyName</p>
<?php
// $circleIdentity=findCircleIDbyName($emailaddress);
// echo $circleIdentity;
//echo $circleIdentity;
/*
$firstName = $conn->real_escape_string($firstName);
$lastName = $conn->real_escape_string($lastName);
$displayName = $conn->real_escape_string($displayName);
$emailaddress = $conn->real_escape_string($emailaddress);

$sql = "INSERT INTO USER(FIRSTNAME, LASTNAME, DISPLAYNAME, EMAILADDRESS) VALUES ('$firstName','$lastName','$displayName','$emailaddress')";
   if ($conn->query($sql) == TRUE) {
	    printf("%d ligne insérée.\n", $conn->affected_rows);
    	echo "New user created successfully";
   } else {
       echo "Error: " . $sql . "<br>" . $conn->error;
   }
    $conn->close();
*/
?>
<p>Function call done</p>
</html>
