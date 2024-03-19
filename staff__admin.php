<?php
session_start();
include_once('db.php'); // Assuming the path to your database connection script is 'serve/db.php'

// Fetch data from the "plots" table
$selectStaffDataQuery = "SELECT * FROM staff";
$stmt = $conn->query($selectStaffDataQuery);
$staffData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch data from the "plots" table
$selectPlotsDataQuery = "SELECT * FROM plots";
$stmt = $conn->query($selectPlotsDataQuery);
$plotsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Update Staff Assign
if (isset($_POST['assign'])) {
    // SQL query to update property_Assign and staffonplot
    $updateAssignQuery = "UPDATE staff SET plot_id = :plot_id WHERE id = :staff_id";
    $stmtAssign = $conn->prepare($updateAssignQuery);
    $stmtAssign->bindParam(':staff_id', $_POST['staff_id']);
    $stmtAssign->bindParam(':plot_id', $_POST['plot_id']);
    $stmtAssign->execute();
    echo "<script>alert('Staff Assigned successfully.');</script>";
}

// Update Staff Remove
if (isset($_POST['remove'])) {
    // SQL query to update property_Assign and staffonplot
    $updateAssignQuery = "UPDATE staff SET plot_id = NULL WHERE id = :staff_id";
    $stmtAssign = $conn->prepare($updateAssignQuery);
    $stmtAssign->bindParam(':staff_id', $_POST['staff_id']);
    //$stmtAssign->bindParam(':plot_id', NULL');
    $stmtAssign->execute();
    echo "<script>alert('Staff rEMOved successfully.');</script>";
}

// fetch the plot
function displayPlot($id)
{
    include('db.php'); // Assuming the path to your database connection script is 'serve/db.php'
    $selectPlotsDataQuery = "SELECT * FROM plots, staff
        WHERE plots.id = staff.plot_id
        AND staff.plot_id = $id";
    $stmt = $conn->query($selectPlotsDataQuery);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $d) {
        echo $d['plot_name'];
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

                <div class="row">
                    <div class="card mb-0">
                        <div class="card-body">
                            <h2> <a href="staff__admin__add.php" class="btn btn-outline-success fs-4 mb-4 rounded-2">Add
                                    Staff</a>
                            </h2>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Property</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($staffData as $staff) : ?>
                                        <tr>
                                            <form action="staff__admin.php" method="post">
                                                <input type="hidden" name="staff_id" value="<?php echo $staff['id']; ?>">
                                                <td>
                                                    <?php echo $staff['id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $staff['staff_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $staff['address']; ?>
                                                </td>
                                                <td>
                                                    <?php if ($staff['plot_id'] == NULL) { ?>
                                                        <select class="form-control" name="plot_id">
                                                            <?php foreach ($plotsData as $plot) : ?>
                                                                <option value="<?php echo $plot['id']; ?>">
                                                                    <?php echo $plot['plot_name']; ?>
                                                                </option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    <?php } else {
                                                        displayPlot($staff['plot_id']);
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($staff['plot_id'] == NULL) : ?>
                                                        <button type="submit" name="assign" class="btn btn-dark">assign</button>
                                                    <?php else : ?>
                                                        <button type="submit" name="remove" class="btn btn-outline-primary">remove</button>
                                                    <?php endif ?>
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