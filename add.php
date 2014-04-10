<h1>Add User</h1>
<form action="/?page=add" method="POST">
	<label for="txtname">Name</label>
	<input id="txtname" name="name" type="text">
	<br/>
	<label for="txtjobtitle">Job Title</label>
	<input id="txtjobtitle" name="job_title" type="text">
	<input type="submit" value="Add User">
</form>
<?php
/*
1) Do we have user data to save? done
2) connect to the database done
3) build a sql statement to insert the user
4) execute the sql
5) show a message that it worked
5.1) Show a message if something went wrong
*/

if (!empty($_POST['name']) && !empty($_POST['job_title'])) {
	echo '<b>we got data</b>';

	$mysqli = new mysqli("localhost", "root", "", "app1");
	if ($mysqli->connect_errno) {
	    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

	$query = 'INSERT INTO USERS (id, name, job_title) VALUES ("' . uniqid() . '", "' . $_POST['name'] . '", "' . $_POST['job_title'] . '");';
	echo $query;
	echo '<br>';

	if ($mysqli->query($query) == false) {
	    echo "User creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
	} else {
		echo 'User was added!';
	}
}
?>