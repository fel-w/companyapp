<?php
// Include session file and config
require_once "session.php";
require_once "config.php";

$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

    if (!$token || $token !== $_SESSION['token']) {
        // show an error message
        $error = "Error: invalid form submission";
        // return 405 http status code
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        exit;
    }

    // sanitize amount, account_name and account_number
    $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_INT);

    $account_name = filter_input(INPUT_POST, 'account_name', FILTER_SANITIZE_STRING);

    $account_number = filter_input(INPUT_POST, 'account_number', FILTER_SANITIZE_NUMBER_INT);

    // Should not submit empty fields
    if (empty($amount) || empty($account_name) || empty($account_number))  {
        $error = "Error : empty information entered";
    }
    else{
        $sql = "INSERT INTO transactions (account_name, account_number, amount) VALUES ('$account_name', '$account_number', '$amount')";

        if (mysqli_query($conn, $sql)) {
            $success = "Transaction Successful! ID : " . mysqli_insert_id($conn);
        } else {
            $error = "Error : " . $sql . "<br>" . $conn->error;
        }

        mysqli_close($conn);
    }

} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // generate a token
	$_SESSION['token'] = bin2hex(random_bytes(35));

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
    <title>Company App (Fixed CSRF Vulnerability)</title>
</head>

<body>
    <div class="container">
        <div class="p-5 text-center bg-light rounded-3">
            <a href="welcome.php" role="button" class="btn btn-outline-secondary btn-lg px-4">Home</a><br><br>
            <h2 class="fw-bold">Funds Transfer</h2>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Send money to supplier account</p>
                <?php
                    if (!empty($success)) {
                        echo '<div class="alert alert-success mt-2">' . $success . '</div>';
                    }
                    if (!empty($error)) {
                        echo '<div class="alert alert-danger mt-2">' . $error . '</div>';
                    }
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="card px-5 py-3">
                    <div class="mb-2">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter the transfered amount">
                    </div>

                    <div class="mb-2">
                        <label for="account_name" class="form-label">Account Name</label>
                        <input type="text" class="form-control" name="account_name" id="account_name" placeholder="Enter the recipient account">
                    </div>

                    <div class="mb-2">
                        <label for="account_number" class="form-label">Account Number</label>
                        <input type="number" class="form-control" name="account_number" id="account_number" placeholder="Enter the recipient account number">
                    </div>

                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">

                    <button type="submit" class="btn btn-primary px-4">Send</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>