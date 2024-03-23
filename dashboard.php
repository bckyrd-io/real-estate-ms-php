<?php
session_start();
include_once('db.php'); // Assuming the path to your database connection script is 'serve/db.php'

// total payment
$payQuery = "SELECT SUM(price) as total FROM plots ,usersonplot
    WHERE usersonplot.plot_id = plots.id 
    AND usersonplot.status = 'paid' ";
$payStmt = $conn->query($payQuery);
$payData = $payStmt->fetchAll(PDO::FETCH_ASSOC);


$stmt = $conn->prepare("SELECT location, COUNT(p.id) AS total_plots, SUM(CASE WHEN usp.status = 'paid' THEN 1 ELSE 0 END) AS sold_plots, COUNT(p.id) - SUM(CASE WHEN usp.status = 'paid' THEN 1 ELSE 0 END) AS available_plots FROM plots p LEFT JOIN usersonplot usp ON p.id = usp.plot_id GROUP BY location;");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Initialize variables for overall counts
$overallTotalPlots = 0;
$overallSoldPlots = 0;
$overallAvailablePlots = 0;


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Real Estate</title>
    <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
    <!-- datatables -->
    <link rel="stylesheet" href="./plugins/jquery.dataTables.min.css">
    <link rel="stylesheet" href="./plugins/buttons.dataTables.min.css">

    <style>
        .dt-button {
            background: none !important;
            border: solid 1px green !important;
            /* color: white !important; */
        }
    </style>
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
                            <a class="sidebar-link" href="dashboard.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="property__admin.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Listings</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./pay__calculation.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-checklist"></i>
                                </span>
                                <span class="hide-menu">Calculator</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./property__admin__approve.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-edit"></i>
                                </span>
                                <span class="hide-menu">Approve</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./property__admin__request.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-location"></i>
                                </span>
                                <span class="hide-menu">Request</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="staff__admin.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="hide-menu">Staff</span>
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
                            <a class="nav-link nav-icon-hover" href="property__admin__approve.php">
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
                <!--  Row 1 -->
                <div class="row">
                    <div class="col-lg-8 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                    <div class="mb-3 mb-sm-0">
                                        <h5 class="card-title fw-semibold">Plots Sales </h5>
                                    </div>
                                    <div>
                                        <select class="form-select">
                                            <option value="1">2024</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">

                            <div class="col-lg-12">
                                <!-- Monthly Earnings -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row alig n-items-start">
                                            <div class="col-8">
                                                <h5 class="card-title mb-9 fw-semibold"> Earnings </h5>
                                                <h4 class="fw-semibold mb-3">$
                                                    <?php echo $payData[0]['total'] ?>
                                                </h4>
                                            </div>
                                            <div class="col-4">
                                                <div class="d-flex justify-content-end">
                                                    <div class="text-white bg-dark rounded-circle p-6 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-currency-dollar fs-6"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="earning"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8  align-items-strech">
                        <div class="card mb-0">
                            <div class="card-body">
                                <table id="example" class="table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Location</th>
                                            <th>Total Plots</th>
                                            <th>Sold Plots</th>
                                            <th>Available Plots</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($results as $row) { ?>
                                            <tr>
                                                <td><?= $row['location'] ?></td>
                                                <td><?= $row['total_plots'] ?></td>
                                                <td><?= $row['sold_plots'] ?></td>
                                                <td><?= $row['available_plots'] ?></td>
                                            </tr>
                                            <?php
                                            // Accumulate overall counts for each location
                                            $overallTotalPlots += $row['total_plots'];
                                            $overallSoldPlots += $row['sold_plots'];
                                            $overallAvailablePlots = $overallTotalPlots - $overallSoldPlots; // Ensure consistency
                                            ?>
                                        <?php } ?>

                                        <tr>
                                            <th>Total</th>
                                            <th><?= $overallTotalPlots ?></th>
                                            <th><?= $overallSoldPlots ?></th>
                                            <th><?= $overallAvailablePlots ?></th>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
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



    <script src="plugins/jquery.dataTables.min.js"></script>
    <script src="plugins/dataTables.buttons.min.js"></script>
    <script src="plugins/jszip.min.js"></script>
    <script src="plugins/pdfmake.min.js"></script>
    <script src="plugins/vfs_fonts.js"></script>
    <script src="plugins/buttons.html5.min.js"></script>
    <script src="plugins/buttons.print.min.js"></script>


    <script>
        $(document).ready(async function() {
            const table = $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf'
                ]
            });
        });
    </script>
</body>

</html>