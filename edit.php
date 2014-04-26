<?php
require("User.php");

if (!empty($_POST['name']) && !empty($_POST['job_title']) && !empty($_POST['phone_number'])) {
	$user = new User();
	$userData = array(
		'name' => $_POST['name'],
		'job_title' => $_POST['job_title'],
		'phone_number' => $_POST['phone_number']
	);
	$user->savedUserDataWithUserId($_GET['userid'], $userData);
}

//make a user object based on our user class
$userToEdit = new User();

//call a method on the object
$userData = $userToEdit->getUserById($_GET['userid']);
?>

<?php if(!empty($userData)) : ?>

<h1>Edit User</h1>
<form action="/?page=edit&userid=<?= $_GET['userid'] ?>" method="POST">
	<label for="txtname">Name</label>
	<input id="txtname" name="name" type="text" value="<?= $userData['name'] ?>">
	<br/>
	<label for="txtjobtitle">Job Title</label>
	<input id="txtjobtitle" name="job_title" type="text" value="<?= $userData['job_title'] ?>">
	<br/>
	<label for="txtphonenumber">Phone Number</label>
	<input id="txtphonenumber" name="phone_number" type="text" value="<?= $userData['phone_number'] ?>">
	<input type="submit" value="Save User">
</form>

<?php endif; ?>