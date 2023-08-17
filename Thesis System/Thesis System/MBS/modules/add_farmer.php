<?php
session_start();
require "../dbconfig/db_conn.php";
$alertOutput = "";

try{
	$conn = DBMySQL::connect();
	if(isset($_POST['submit'])){
		$lastName = $_POST['lastName'];
		$firstName = $_POST['firstName'];
		$middleName = $_POST['middleName'];
		$address = $_POST['address'];
		$brgyID = $_POST['brgyID'];
		$spouse = $_POST['spouse'];
		if(!isset($_SESSION['id'])){
			die("User is not logged in");
			//redirect to guest homepage
		}
		$userID = $_SESSION['id'];
		$query = $conn->prepare("INSERT INTO farmer(last_name, first_name, middle_name, address, brgy_id, spouse_first_name, user_id) VALUES(?, ?, ?, ?, ?, ?, ?)");
		$query->bind_param("ssssisi", $lastName, $firstName, $middleName, $address, $brgyID, $spouse);
		$query->execute();
		$alertOutput = "Successfully registered farmer, please wait for admin approval";
	}
	$query = $conn->query("SELECT id, name FROM barangay ORDER BY name");
	$ddBrgy = "";
	while($row = $query->fetch_assoc())
		$ddBrgy .= sprintf("<option value='%d'>%s</option>", $row['id'], $row['name']);
}
catch(Exception $e){
	$alertOutput = print_r($e, true);
}
finally{
	$conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../lib/farmer.css">
	<title>Add farmer</title>
</head>
<body>
	<?php echo $alertOutput;?>
	<div class="container">
        <div class="box form-box">
        <div class="center-content">
                <h3>Add Farmer</h3>
                <div class="divider"></div>
            </div>
            <form action="" method="post">
                <div class="field input">
                    <label for="lastName"> Last Name</label>
                    <input type="text" name="lastName" id="lastName" autocomplete="off" required>
                </div>

				<div class="field input">
									<label for="firstName">First Name</label>
									<input type="text" name="firstName" id="firstName" autocomplete="off" required>
				</div>

				<div class="field input">
									<label for="middleName">Middle Name</label>
									<input type="text" name="middleName" id="middleName" autocomplete="off" required>
				</div>

				<div class="field input">
									<label for="address">Address</label>
									<input type="text" name="address" id="address" autocomplete="off" required>
				</div>

				<div class="field input">
									<label for="brgyID">Barangay</label>
								<select name="brgyID" class="brgyID">
									<?php echo $ddBrgy; ?>
								</select>
                </div>

                <div class="field input">
                    <label for="spouse">Spouse first name (optional)</label>
                    <input type="text" name="spouse" id="spouse" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Submit" required>
                </div>

				<div class="links">
                    Already have an account? <a href="user_login.php">Log In</a>
                </div>
</form>
</body>
</html>