<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
	header("location: welcome.php");
	exit;
}

// Include config file
require_once "config.php";

$login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
	$pass = trim(md5($_POST["pass"]));

	$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";
	$result = $conn->query($sql);

	// If there is a result
	echo "Num rows ";
	// echo "Num rows ".$result->num_rows;
	if ($result->num_rows == 1) {
		if ($row = $result->fetch_assoc()) {
			session_start();

			$_SESSION["loggedin"] = true;
			$_SESSION['userid'] = $user['id'];

			// Redirect user to welcome page
			header("location: welcome.php");
		}
	} else {
		$login_err = "Please enter correct credentials";
	}

	// Close connection
	mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<style>
		body {
			height: 100vh;
			display: flex;
			flex-direction: column;
			justify-content: center;
		}
	</style>
	<title>Company App</title>
</head>

<body>
	<div class="container">
		<div class="mb-4 bg-light rounded-3 p-4">
			<h1 class="display-5 fw-bold">Company Manager</h1>
		</div>
		<div class="row align-items-md-stretch">
			<div class="col-md-6">
				<div class="h-100 p-5 text-white bg-dark rounded-3">
					<h2>All you need is here!</h2><br>
					<p>Manage your organization with all the tools needed. <br>
						Login and get started</p>
				</div>
			</div>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="col-md-6">
				<div class="h-100 p-5 bg-light border rounded-3">
					<h2>Login</h2><br>
					<div class="form-floating mb-2">
						<input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
						<label for="floatingInput">Email address</label>
					</div>
					<div class="form-floating mb-2">
						<input type="password" class="form-control" name="pass" id="floatingPassword" placeholder="Password">
						<label for="floatingPassword">Password</label>
					</div>

					<!-- Adds the CRSF token in hidden field  -->
					<input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">

					<button class="w-100 btn btn-lg btn-outline-secondary" type="submit">Login</button>
					<?php
						if (!empty($login_err)) {
							echo '<div class="alert alert-danger mt-2">' . $login_err . '</div>';
						}
					?>
				</div>
			</form>
		</div>
	</div>
	<!-- Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>