<?php

function findCircleIDbyName($circleName)
{
	 require 'config.php';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // $sql = "INSERT INTO USER(FIRSTNAME, LASTNAME, DISPLAYNAME, EMAILADDRESS)
    // VALUES ($firstName, $lastName, $userName, $emailaddress)";
		$sql = sprintf("SELECT ID FROM CIRCLE WHERE (NAME = '%s')",
            mysql_real_escape_string($circleName));
    if ($conn->query($sql) === TRUE) {
        echo "New User created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}





 ?>
