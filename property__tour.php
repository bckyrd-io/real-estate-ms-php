<?php
session_start();
include_once('db.php'); // Assuming the path to your database connection script is 'serve/db.php'
$selectedPlotId = $_GET['id']; // Example plot ID

// Query to fetch plot details
$queryPlotDetails = "SELECT * FROM plots WHERE id = :plot_id";
$stmt = $conn->prepare($queryPlotDetails);
$stmt->execute(['plot_id' => $selectedPlotId]);
$plotDetails = $stmt->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['request'])) {
    // Validate plot_id (optional, good practice)
    $plot_id = (int) $_POST['plot_id']; // Cast to integer for security

    // Check if plot exists for the user
    $checkPlotQuery = "SELECT COUNT(*) AS user_plot_count 
                       FROM usersonplot 
                       WHERE plot_id = :plot_id AND user_id = :user_id";
    $stmtCheckPlot = $conn->prepare($checkPlotQuery);
    $stmtCheckPlot->bindParam(':plot_id', $plot_id);
    $stmtCheckPlot->bindParam(':user_id', $_SESSION['user_id']);
    $stmtCheckPlot->execute();

    $userPlotCount = $stmtCheckPlot->fetchColumn(); // Get the count
    $stmtCheckPlot->closeCursor(); // Close the cursor

    if ($userPlotCount > 0) {
        // Plot exists for the user, proceed with update
        $status = 'visit';
        $user_id = $_SESSION['user_id'];
        // Update usersonplot table
        $updateToursQuery = "UPDATE usersonplot SET status= :status WHERE plot_id = :plot_id 
                         AND user_id = :user_id";
        $stmtTours = $conn->prepare($updateToursQuery);
        $stmtTours->bindParam(':plot_id', $plot_id);
        $stmtTours->bindParam(':user_id', $user_id);
        $stmtTours->bindParam(':status', $status);
        if ($stmtTours->execute()) {
            echo " <script> alert('Request sent successfully. Wait for email!')</script>";
        } else {
            echo " <script> alert('There was an error processing your request.')</script>";
        }
    } else {
        echo "  <script> alert('You cannot request this plot. It might not be assigned to you.')</script>";
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Real Estate Ms</title>
    <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
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

                <div class="col">
                    <?php if ($plotDetails) : ?>
                        <h4>Tour Of
                            <?php echo htmlspecialchars($plotDetails['plot_name']); ?> -
                            <?php echo htmlspecialchars($plotDetails['location']); ?>
                        </h4>
                    <?php endif; ?>

                    <!-- Display additional plot media with descriptions -->
                    <form action="" method="post" class="row justify-content-between w-100">
                        <!-- <div class="row justify-content-center w-100"> -->
                        <input type="hidden" name="plot_id" value="<?= $plotDetails['id'] ?>">
                        <button type="submit" class="btn btn-outline-primary mt-2" name="request">Request For Visit</button>
                        <a href="property__virtual.php?id=<?php echo $_GET['id']; ?>" target="_blank" class="btn btn-outline-primary mt-2">Take Virtual Tour</a>
                    </form>
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