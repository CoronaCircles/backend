<?php
// port of python code for coronacircles project
// chris rehm, christopherrehm@web.de apr3 2020

function insertNewUser($firstName, $lastName, $displayName, $emailaddress)
{
	require 'config.php';
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
	$firstName = $conn->real_escape_string($firstName);
	$lastName = $conn->real_escape_string($lastName);
	$displayName = $conn->real_escape_string($displayName);
	$emailaddress = $conn->real_escape_string($emailaddress);
	$sql = "INSERT INTO USER(FIRSTNAME, LASTNAME, DISPLAYNAME, EMAILADDRESS)  VALUES ('$firstName','$lastName','$displayName','$emailaddress')";
  if ($conn->query($sql) === TRUE) {
     echo "New user created successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
	$returnId = $conn->insert_id;
	printf ("<p>New Record has id %d.\n</p>", $returnId);
	return($returnId);
  $conn->close();
	// return user Id
	// return()
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
		$circleName=$conn->real_escape_string($circleName);
		$description=$conn->real_escape_string($description);
		$frequency=$conn->real_escape_string($frequency);
		$url=$conn->real_escape_string($url);
    $sql = "INSERT INTO CIRCLE(NAME, DESCRIPTION, FREQUENCY, URL) VALUES ('$circleName','$description','$frequency','$url')";
    if ($conn->query($sql) === TRUE) {
        echo "New circle created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$conn->close();
		// return circle Id
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
		$circleID=$conn->real_escape_string($circleID);
		$userID=$conn->real_escape_string($userID);
    $sql = "INSERT INTO CIRCLEUSER (CU2CIRCLE, CU2USER, ISHOST) VALUES ('$circleID', '$userID', '1')";

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
		$circleID=$conn->real_escape_string($circleID);
		$hostID=$conn->real_escape_string($hostID);
    $sql = "INSERT INTO CIRCLEUSER (CU2CIRCLE, CU2USER, ISHOST) VALUES ('$circleID', '$hostID', '0')";
    if ($conn->query($sql) === TRUE) {
        echo "Added new host to circle successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function findCircleIDbyName($circleName)
{

	// is it an error if there is no circle with this name ??
	 require 'config.php';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
		$circleName = $conn->real_escape_string($circleName);
	 	$sql = "SELECT ID FROM CIRCLE WHERE (NAME = '$circleName')";
    if ($conn->query($sql) === TRUE) {
        echo "Successfully found circle ID by name";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
		// return($conn->mysqli_fetch_array())
    $conn->close();
}

/*
function findCirclesForAUser($userEmail)
{
	require 'config.php';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
		$userEmail=$conn->real_escape_string($userEmail));

	 $sql = "SELECT c.ID, c.NAME, c.DESCRIPTION, c.URL, 'Host' ISHOST
    FROM USER u, (SELECT ID FROM USER WHERE
    EMAILADDRESS='$userEmail') curr, CIRCLEUSER cu, CIRCLE c
    WHERE u.ID = curr.ID
    AND cu.CU2USER = u.ID
    AND cu.CU2CIRCLE = c.ID
    AND cu.ISHOST = 1
    UNION
    SELECT c.ID, c.NAME, c.DESCRIPTION, c.URL, 'Guest'
    FROM USER u, (SELECT ID FROM USER WHERE
    EMAILADDRESS='$userEmail') curr, CIRCLEUSER cu, CIRCLE c
    WHERE u.ID = curr.ID
    AND cu.CU2USER = u.ID
    AND cu.CU2CIRCLE = c.ID
    AND cu.ISHOST = 0";
    //$result = $conn->query($sql);
    if ($conn->query($sql) === TRUE) {
        echo "successfully found all circles for a user";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    //return $result;
}
/*
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
*/
