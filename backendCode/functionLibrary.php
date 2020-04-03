<?php
// port of python code for coronacircles project
// chris rehm, christopherrehm@web.de apr3 2020


function insertNewUser($firstName, $lastName, $userName, $emailaddress)
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
		$sql = sprintf("INSERT INTO USER(FIRSTNAME, LASTNAME, DISPLAYNAME, EMAILADDRESS)  VALUES ('%s','%s','%s','%s')",
            mysql_real_escape_string($user),
            mysql_real_escape_string($lastName),
						mysql_real_escape_string($userName),
						mysql_real_escape_string($emailadress));
    if ($conn->query($sql) === TRUE) {
        echo "New User created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function insertNewCircle($circleName, $description, $frequency, $url)
{
		require 'config.php';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = sprintf("INSERT INTO CIRCLE(NAME, DESCRIPTION, FREQUENCY, URL) VALUES ('%s','%s','%s','%s')",
		mysql_real_escape_string($circleName),
		mysql_real_escape_string($description),
		mysql_real_escape_string($frequency),
		mysql_real_escape_string($url));

    if ($conn->query($sql) === TRUE) {
        echo "New Circle created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
