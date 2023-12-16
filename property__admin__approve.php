<?php
session_start();
include_once('db.php'); // Assuming the path to your database connection script is 'serve/db.php'

// Fetch data from the "plots" table
$selectDataQuery = "SELECT 
    t.id as tour_id, 
    t.tour_date, 
    t.appointment_status, 
    p.plot_name, 
    p.location, 
    p.price, 
    pay.amount as payment_amount,
    pay.payment_date,
    u.username,
    u.id as user_id,
    u.email
    FROM property_tours t
    JOIN plots p ON t.plot_id = p.id
    LEFT JOIN payments pay ON p.id = pay.plot_id
    LEFT JOIN users u ON pay.user_id = u.id";
$stmt = $conn->query($selectDataQuery);
$resultsData = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Fetch data from the "plots" table
$selectPlotsDataQuery = "SELECT * FROM plots";
$stmtPlots = $conn->query($selectPlotsDataQuery);
$plotsData = $stmtPlots->fetchAll(PDO::FETCH_ASSOC);


// Submited Notifications

if (isset($_POST['submit'])) {
    echo $plot_id = $_POST['plot_id'];
    echo $tour_date = $_POST['tour_date'];
    // SQL query to insert media data
    $updateQuery = "INSERT INTO plot_media (plot_id, media_type, media_path, description) VALUES (:plot_id, :media_type, :media_path, :description)";
    $stmt = $conn->prepare($updateQuery);



    echo "<script>alert('Update added successfully.');</script>";
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
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="assets/images/logos/dark-logo.svg" width="180" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./index.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Property Listings</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-plus"></i>
                                </span>
                                <span class="hide-menu">Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-cards"></i>
                                </span>
                                <span class="hide-menu">Payments</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-alert-circle"></i>
                                </span>
                                <span class="hide-menu">Notifications</span>
                            </a>
                        </li>

                    </ul>
                    <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
                        <div class="d-flex">
                            <div class="unlimited-access-title me-3">
                                <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Lets Go Home</h6>
                                <a href="index.html" target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Click</a>
                            </div>
                            <div class="unlimited-access-img">
                                <img src="assets/images/backgrounds/rocket.png" alt="" class="img-fluid">
                            </div>
                        </div>
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
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
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
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a>
                                        <a href="logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
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
                            <!-- <h2>Plots Data</h2> -->

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Property</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($resultsData as $plot) : ?>
                                        <tr>
                                            <td><?php echo $plot['username']; ?></td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="badge 
                                                    <?php
                                                    switch (strtolower('pending')) {
                                                        case 'pending':
                                                            echo 'bg-warning';
                                                            break; // Yellow
                                                        case 'approved':
                                                            echo 'bg-success';
                                                            break; // Green
                                                        case 'applied':
                                                            echo 'bg-primary';
                                                            break; // Blue
                                                            // Add more cases as needed
                                                        default:
                                                            echo 'bg-secondary'; // Default color
                                                    }
                                                    ?>
                                                    rounded-3 fw-semibold"><?php echo 'pending'; ?></span>
                                                </div>
                                            </td>
                                            <td><?php echo $plot['payment_amount']; ?></td>
                                            <form action="" method="post">
                                                <td>
                                                    <select name="plot_id" class=" form-control form-control-md" aria-label="Default select example">
                                                        <option selected>Select:</option>
                                                        <?php foreach ($plotsData as $property) : ?>
                                                            <option value="<?php echo $property['id']; ?>"><?php echo $property['plot_name']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="date" name="tour_date" class="form-control form-control-md" aria-describedby="Select Date">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="user_id" value="<?php echo $plot['user_id']; ?>">
                                                    <button type="submit" name="submit" class="btn btn-outline-primary fs-2 fw-semibold form-control form-control-md">Send</button>
                                                </td>
                                            </form>


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