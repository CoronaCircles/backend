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
        echo "New user created successfully";
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
        echo "New circle created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function addNewUserToCircle($circleID, $userID) 
{
		require 'config.php';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = sprintf("INSERT INTO CIRCLEUSER (CU2CIRCLE, CU2USER, ISHOST)
             VALUES ('%s', '%s', '1')",
		mysql_real_escape_string($circleID),
		mysql_real_escape_string($userID));

    if ($conn->query($sql) === TRUE) {
        echo "Added new user to circle successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();	
}

function addNewHostToCircle($circleID, $hostID) 
{
		require 'config.php';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = sprintf("INSERT INTO CIRCLEUSER (CU2CIRCLE, CU2USER, ISHOST)
             VALUES ('%s', '%s', '0')",
		mysql_real_escape_string($circleID),
		mysql_real_escape_string($hostID));

    if ($conn->query($sql) === TRUE) {
        echo "Added new host to circle successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();	
}

function findCircleIDbyName($circleName)
{
	 require 'config.php';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
	 $sql = sprintf("SELECT ID FROM CIRCLE WHERE (NAME = '%s')",
           mysql_real_escape_string($circleName));
      //$result = $conn->query($sql);
    if ($conn->query($sql) === TRUE) {
        echo "Successfully found circle ID by name";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    //return $result;
}

function findCirclesForAUser($userEmail)
{
	require 'config.php';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
	 $sql = sprintf("SELECT c.ID, c.NAME, c.DESCRIPTION, c.URL, 'Host' ISHOST
    FROM USER u, (SELECT ID FROM USER WHERE
    EMAILADDRESS='%s') curr, CIRCLEUSER cu, CIRCLE c
    WHERE u.ID = curr.ID
    AND cu.CU2USER = u.ID
    AND cu.CU2CIRCLE = c.ID
    AND cu.ISHOST = 1
    UNION
    SELECT c.ID, c.NAME, c.DESCRIPTION, c.URL, 'Guest'
    FROM USER u, (SELECT ID FROM USER WHERE
    EMAILADDRESS='%s') curr, CIRCLEUSER cu, CIRCLE c
    WHERE u.ID = curr.ID
    AND cu.CU2USER = u.ID
    AND cu.CU2CIRCLE = c.ID
    AND cu.ISHOST = 0",
           mysql_real_escape_string($userEmail));
           mysql_real_escape_string($userEmail));
    //$result = $conn->query($sql);
    if ($conn->query($sql) === TRUE) {
        echo "successfully found all circles for a user";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    //return $result;
}

function findCirclesForAUserGuest($userEmail)
{
	require 'config.php';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {    
        die("Connection failed: " . $conn->connect_error);
    }
        die("Connection failed: " . $conn->connect_error);
    }
    
	 $sql = sprintf("SELECT c.ID, c.NAME, c.DESCRIPTION, c.URL, 'Host' ISHOST
    FROM USER u, (SELECT ID FROM USER WHERE EMAILADDRESS='%s')
    curr, CIRCLEUSER cu, CIRCLE c
    WHERE u.ID = curr.ID
    AND cu.CU2USER = u.ID
    AND cu.CU2CIRCLE = c.ID
    AND cu.ISHOST = 0",
           mysql_real_escape_string($userEmail));
    //$result = $conn->query($sql);
    if ($conn->query($sql) === TRUE) {
        echo "successfully found all circles for a user-guest";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    //return $result;

}

function findCirclesForAUserHost($userEmail) {
	require 'config.php';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {    
        die("Connection failed: " . $conn->connect_error);
    }
        die("Connection failed: " . $conn->connect_error);
    }
    
	 $sql = sprintf("SELECT c.ID, c.NAME, c.DESCRIPTION, c.URL, 'Host' ISHOST
    FROM USER u, (SELECT ID FROM USER WHERE EMAILADDRESS='%s')
    curr, CIRCLEUSER cu, CIRCLE c
    WHERE u.ID = curr.ID
    AND cu.CU2USER = u.ID
    AND cu.CU2CIRCLE = c.ID
    AND cu.ISHOST = 1",
           mysql_real_escape_string($userEmail));
    //$result = $conn->query($sql);
    if ($conn->query($sql) === TRUE) {
        echo "successfully found all circles for a user-host";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    //return $result;
}