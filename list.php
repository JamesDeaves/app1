<?php
$mysqli = new mysqli("localhost", "root", "", "app1");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$query = "SELECT users.id, users.name, users.job_title, users.phone_number, users.add1 FROM users";
?>

<h1>List of Users</h1>

<table border="1">
 <tr>
  <th>Name</th>
  <th>Job Title</th>
  <th>Phone Number</th>
  <th>Address 1</th>
  <th>Actions</th>
 </tr>

<?php
if ($statement = $mysqli->prepare($query)) {
	$statement->execute();
	$statement->bind_result($id, $name, $jobTitle, $phoneNumber, $address1);
	while ($statement->fetch()) {
		?>

        <tr>
        	<td><?= $name ?></td>
        	<td><?= $jobTitle ?></td>
        	<td><?= $phoneNumber ?></td>
        	<td><?= $address1 ?></td>
        	<td><a href="/?page=edit&userid=<?= $id ?>">Edit User</a></td>
        </tr>

     <?php

    }
    $statement->close();
}
?>