<?php
class User {
	
	/**
		Method to get a user by a user ID
		1) Connect to the database
		2) Make a SQL statement
		3) Prepare SQL Statement & bind parameters
		4) Execute SQL and try to fetch 1 row
		5) If we get a row we return an array of the user data
		6) If we don't get a row we return boolean false
	*/
	public function getUserById($id) {
		$mysqli = new mysqli("localhost", "root", "", "app1");
		if ($mysqli->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$query = "SELECT users.id, users.name, users.job_title, users.phone_number FROM users where users.id=?";

		if ($statement = $mysqli->prepare($query)) {
			$statement->bind_param("s", $id);
			$statement->execute();
			$statement->bind_result($id, $name, $jobTitle, $phoneNumber);

			if ($statement->fetch()) {
				$statement->close();
				return array(
					'id' => $id,
					'name' => $name,
					'job_title' => $jobTitle,
					'phone_number' => $phoneNumber
				);
			} else {
				$statement->close();
				return false;
			}
		} else {
			echo 'Could not prepare statement';
		}
	}

	public function savedUserDataWithUserId($id, Array $userData) {
		$mysqli = $this->getMysqliObject();
		$query = 'UPDATE users SET users.name = ?, users.job_title = ?, users.phone_number = ? WHERE users.id = ?';
		if ($statement = $mysqli->prepare($query)) {
			$statement->bind_param("ssss", $userData['name'], $userData['job_title'], $userData['phone_number'], $id);
			$result = $statement->execute();
			echo $result;
		}
	}

	private function getMysqliObject() {
		$mysqli = new mysqli("localhost", "root", "", "app1");
		if ($mysqli->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		    return false;
		}
		return $mysqli;
	}
}