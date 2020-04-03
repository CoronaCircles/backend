// port of python code for coronacircles project
// chris rehm, christopherrehm@web.de apr3 2020


<?php
$servername = "rdbms.strato.de";
$username = "U4098787";
$password = "1light1light!!";
$dbname = "DB4098787";

function insertNewUser($firstName, $lastName, $userName, $emailaddress)
{
	 global $servername, $username,$password,$dbname;
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO USER(FIRSTNAME, LASTNAME, DISPLAYNAME, EMAILADDRESS) 
    VALUES ($firstName, $lastName, $userName, $emailaddress)";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function insertNewCircle($circleName, $description, $frequency, $url) 
{
	 global $servername, $username,$password,$dbname;
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO USER(FIRSTNAME, LASTNAME, DISPLAYNAME, EMAILADDRESS) 
    VALUES ($circleName, $description, $frequency,$url)";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
