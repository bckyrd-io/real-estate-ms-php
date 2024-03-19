<?php
session_start();

if (isset($_POST['submit'])) {
    include_once('db.php'); // Assuming the path to your database connection script is './db.php'

    // Get user input
    $email = $_POST['email']; // Fix: Change '$_POST['username']' to '$_POST['email']'
    $password = $_POST['password'];


    // SQL query to retrieve user data based on email
    $selectQuery = "SELECT id, username, password, role FROM users WHERE email = :email";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Fetch user data
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header('Location: dashboard.php'); // Change 'dashboard.php' to the appropriate page
        } else {
            header('Location: property__listings.php'); // Change 'dashboard.php' to the appropriate page
        }

        // Redirect to a dashboard or home page
        exit();
    } else {
        // Display an error message for invalid credentials
        // Execute JavaScript to show an alert
        echo "<script>alert('Invailid Username or Password.');</script>";
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Real-Estate</title>
    <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <a href="./index.php" class="text-nowrap logo-img">

                            <img src="assets/images/logos/favicon.png" height="30px" alt="" />
                            <strong class="text-primary">CHERRYWOOD</strong>
                            <p class="col-md-6">Real Estate Management</p>
                        </a>
                        <div class="card mb-0">
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Remeber this Device
                                            </label>
                                        </div>
                                        <a class="text-primary fw-bold" href="./index.php">Forgot Password ?</a>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">Are you new?</p>
                                        <a class="text-primary fw-bold ms-2" href="./auth__register.php">Create an account</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>