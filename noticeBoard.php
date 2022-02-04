<?php
// Include session file and config
require_once "session.php";
require_once "config.php";

$error = $success = $notice = "";
$count = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $notice = filter_input(INPUT_POST, 'notice', FILTER_SANITIZE_STRING);
    // $notice = $_POST['notice'];

    // Should not submit empty fields
    if (empty($notice)) {
        $error = "Please enter valid information";
    } else {
        $sql = "INSERT INTO notice_board (notice) VALUES ('$notice')";

        if (mysqli_query($conn, $sql)) {
            $success = "Successful! ID : " . mysqli_insert_id($conn);
        } else {
            $error = "Error : " . $sql . "<br>" . $conn->error;
        }
    }
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
    <title>Company App (XSS Vulnerability)</title>
</head>

<body>
    <div class="container">
        <div class="p-3 text-center bg-light rounded-3">
            <a href="welcome.php" role="button" class="btn btn-outline-secondary btn-lg px-4">Home</a><br><br>
            <h2 class="fw-bold">Staff Notice Board</h2>
            <p class="lead mb-4">Post important information for your staff to view</p>
        </div><br>

        <div class="row align-items-md-stretch">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="col-md-6">
                <div class="h-100 p-5 border rounded-3">
                    <h4>Post a Notice</h4><br>

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
                            <label for="notice" class="form-label">Notice</label>
                            <textarea type="textfield" class="form-control" name="notice" id="notice"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary px-4">Post</button>
                    </form>
                </div>
            </form>
            <div class="col-md-6">
                <div class="h-100 p-5 text-white bg-dark rounded-3">
                    <h4>Notices</h4><br>
                    <?php
                    // get what to display
                    $sql2 = "SELECT notice from notice_board";
                    $result = mysqli_query($conn, $sql2);

                    //compilation of notices
                    $notices = "";
                    if (mysqli_num_rows($result) > 0) {
                        // compile out put
                        while ($row = mysqli_fetch_assoc($result)) {
                            $count++;
                            echo "<p>" . $count . " - " . $row["notice"] . "</p>";
                        }
                    } else {
                        echo "No notices!";
                    }

                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>