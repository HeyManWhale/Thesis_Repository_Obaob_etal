<?php
require "../dbconfig/db_conn.php";
$alertOutput = "";
try{
	$conn = DBMySQL::connect();
	if(isset($_POST['submit'])){
		$name = trim($_POST['name']);
		$username = trim($_POST['username']);
		$password = md5(trim($_POST['password']));
		$roleID = $_POST['role'];
		$query = $conn->prepare("INSERT INTO user(name, username, password, role_id) VALUES(?, ?, ?, ?)");
		//string, string, string, integer
		$query->bind_param("sssi", $name, $username, $password, $roleID);
		$query->execute();

		$alertOutput = "Successfully registered user, please wait for admin approval";
	}
	$query = $conn->query("SELECT id, name from role");
	$ddRole = "";
	while($row = $query->fetch_assoc())
		$ddRole .= sprintf("<option value='%d'>%s</option>", $row['id'], $row['name']);
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
	<link rel="stylesheet" type="text/css" href="../lib/user.css">
	<title>Add user</title>
</head>
<body>
	<?php echo $alertOutput;?>
	<div class="container">
        <div class="box form-box">
		<div class="center-content">
                <h3>Register User</h3>
                <div class="divider"></div>
            </div>
            <form action="" method="post">
                <div class="field input">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" autocomplete="off" required>
                </div>

				<div class="field input">
									<label for="username">Username</label>
									<input type="text" name="username" id="username" autocomplete="off" required>
								</div>

				<div class="field input">
                    <label for="role">Role</label>
                   <select name="role" class="role">
						<?php echo $ddRole; ?>
					</select>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
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