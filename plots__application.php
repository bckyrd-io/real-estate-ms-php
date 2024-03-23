<?php
session_start();
include_once('db.php'); // Assuming the path to your database connection script is 'serve/db.php'

$user_id = $_SESSION['user_id'];
// Fetch data from the "plots" table
$selectPlotsDataQuery = "SELECT * FROM plots, users, usersonplot
WHERE usersonplot.user_id = users.id 
AND usersonplot.plot_id = plots.id 
AND usersonplot.user_id = $user_id";
$stmtPlots = $conn->query($selectPlotsDataQuery);
$plotsData = $stmtPlots->fetchAll(PDO::FETCH_ASSOC);


// Submit plot application
if (isset($_POST['apply'])) {
    // Fetch of listed plot
    $plotName = "%" . $_POST['plot_name'] . "%"; // Prepare the plot name for a LIKE search
    $query = "SELECT id FROM plots WHERE plot_name LIKE :plotName LIMIT 1"; // Use LIKE in your query
    $stmt = $conn->prepare($query); // Prepare the statement
    $stmt->execute([':plotName' => $plotName]); // Execute with parameters
    $plot = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result

    if ($plot !== false) {
        $plot_id = $plot['id']; // Here's your plot ID
        // Do something with $plot_id
        // Default status
        $user_id = $_SESSION['user_id'];
        $status = 'applied';
        $date = date("Y-m-d");

        // SQL query to insert user data
        $insertQuery = "INSERT INTO usersonplot ( user_id, plot_id, status, date ) 
                VALUES ( :user_id, :plot_id, :status, :date )";
        $stmt = $conn->prepare($insertQuery);

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':plot_id', $plot_id);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':date', $date);
        $stmt->execute();

        // Execute JavaScript to show a success alert
        echo "<script>alert('Application submitted successfully.');</script>";
    } else {
        // Plot not found
        echo "<script>alert('that doesnt exist to apply for .');</script>";
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Real Estate</title>
    <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.php" class="text-nowrap logo-img">
                        <img src="assets/images/logos/favicon.png" height="30px" alt="" />
                        <strong class="text-primary">CHERRYWOOD</strong>

                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./property__listings.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-map"></i>
                                </span>
                                <span class="hide-menu">Property Listings</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./plots__application.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-clipboard"></i>
                                </span>
                                <span class="hide-menu">Application</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./invoice__pay.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-cards"></i>
                                </span>
                                <span class="hide-menu">Payments</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./help__faq.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-help"></i>
                                </span>
                                <span class="hide-menu">Help Feature</span>
                            </a>
                        </li>

                    </ul>
                    <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
                        <a class="d-flex" href="index.php">
                            <div class="unlimited-access-title me-3">
                                <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Go Home __</h6>
                            </div>
                            <div class="unlimited-access-img">
                                <img src="assets/images/backgrounds/rocket.png" alt="" class="img-fluid">
                            </div>
                        </a>
                    </div>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="plots__application.php">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <!-- <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a> -->
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="./logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">


                <div class="row">
                    <div class="card mb-0">
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="exampleInputtext1" class="form-label">User Name</label>
                                    <input type="text" name="user_name" class="form-control" id="exampleInputtext1" placeholder="use your username only here" required>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputtext1" class="form-label">Plot Name</label>
                                    <input type="text" name="plot_name" class="form-control" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Make Sure the Plot Name Matches" required>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputtext1" class="form-label">Location</label>
                                    <input type="text" name="location" class="form-control" id="exampleInputtext1" aria-describedby="textHelp" required>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputtext1" class="form-label">Type</label>
                                    <select name="type" id="" class="form-control" aria-describedby="textHelp" required>
                                        <option value="Residential">Residential</option>
                                        <option value="Commecial">Commecial</option>
                                    </select>
                                </div>


                                <button type="submit" name="apply" class="btn btn-outline-primary fs-4 mb-4 rounded-2">Click To Apply</button>
                            </form>
                            <!-- <h2>Plots Data</h2> -->

                            <table class="table">
                                <thead>
                                    <!-- <tr>
                                        <th>Plot Name</th>
                                        <th>location</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr> -->
                                </thead>
                                <tbody>
                                    <?php foreach ($plotsData as $plot) : ?>
                                        <tr>
                                            <td><?= $plot['plot_name']; ?></td>
                                            <td><?= $plot['location']; ?></td>
                                            <td><?= $plot['type']; ?></td>
                                            <td>$ <?= $plot['price']; ?></td>
                                            <td><?= $plot['date']; ?></td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="badge 
                                                    <?php
                                                    switch (strtolower($plot['status'])) {
                                                        case 'scheduled':
                                                            echo 'bg-warning';
                                                            break; // Yellow
                                                        case 'paid':
                                                            echo 'bg-success';
                                                            break; // Green
                                                        case 'applied':
                                                            echo 'bg-dark';
                                                            break; // Blue
                                                        default:
                                                            echo 'bg-secondary'; // Default color
                                                    }
                                                    ?>
                                                    rounded-3 fw-semibold"><?= $plot['status']; ?></span>
                                                </div>
                                            </td>

                                            <td></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sidebarmenu.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="assets/js/dashboard.js"></script>
</body>

</html>