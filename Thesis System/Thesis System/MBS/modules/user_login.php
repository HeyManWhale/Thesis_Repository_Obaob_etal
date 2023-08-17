<?php
session_start();
require "../dbconfig/db_conn.php";
$alertOutput = "";

if (isset($_POST['submit'])) {
    try {
        $username = trim($_POST['username']);
        $password = md5(trim($_POST['password']));
        $conn = DBMySQL::connect();
        $query = $conn->prepare("SELECT id, name, status FROM user WHERE username = ? AND password = ?");
        $query->bind_param("ss", $username, $password);
        $query->execute();
        $result = $query->get_result();
        
        if ($result->num_rows > 0) {
            $obj = $result->fetch_assoc();
            if ($obj['status'] != 1) {
                $alertOutput = "This user is not active";
            } else {
                $_SESSION['id'] = $obj['id'];
                $_SESSION['name'] = $obj['name'];
                echo "<script>window.location='header_user'</script>";
                // launch homepage with different header
            }
        }
    } catch (Exception $e) {
        $alertOutput = print_r($e, true);
    } finally {
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../lib/login.css">
    <title>Login</title>
</head>
<body>
    <?php echo $alertOutput; ?>
	<div class="container">
        <div class="box form-box">
        <div class="center-content">
                <h3>LOG IN</h3>
                <div class="divider"></div>
            </div>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have account for farmers? <a href="add_farmer.php">Sign Up Now</a>
					<br>Don't have account for user? <a href="add_user.php">Sign Up Now</a><br>
                </div>
            </form>
        </div>
        <?php ?>
      </div>
    </form>
</body>
</html>
