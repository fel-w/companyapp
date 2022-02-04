<?php 
    // Include session file
    require_once "session.php";
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
        <div class="px-4 py-5 my-5 text-center bg-light rounded-3">
            <h1 class="display-5 fw-bold">Welcome to Company App</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">What would you like to do today?</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="fundsTransfer.php" role="button" class="btn btn-primary btn-lg px-4 gap-3">Funds Transfer</a>
                    <a href="noticeBoard.php" role="button" class="btn btn-outline-secondary btn-lg px-4">Notice Board</a>
                </div>
                <br><br>
                <a href="logout.php" role="button" class="btn btn-secondary btn-lg px-4 gap-3">Logout</a>
            </div>
        </div>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>