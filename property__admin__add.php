<?php
session_start();
if (isset($_POST['submit'])) {
    include_once('db.php');

    // Get plot input
    $plotName = $_POST['plot_name'];
    $location = $_POST['location'];
    $type = $_POST['type'];
    $size = $_POST['size'];
    $price = $_POST['price'];

    // File upload handling
    $uploadDir = 'uploads/';  // Specify the directory for uploading images
    $uploadFile = $uploadDir . basename($_FILES['property_image']['name']);

    if (move_uploaded_file($_FILES['property_image']['tmp_name'], $uploadFile)) {
        // Image uploaded successfully, proceed with database insertion

        // SQL query to insert plot data
        $insertQuery = "INSERT INTO plots (plot_name, location, type, size, price, image_path) VALUES (:plot_name, :location, :type, :size, :price, :image_path)";

        // Prepare the SQL statement
        $stmt = $conn->prepare($insertQuery);

        // Bind parameters
        $stmt->bindParam(':plot_name', $plotName);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image_path', $uploadFile);

        // Execute the statement
        $stmt->execute();

        // Execute JavaScript to show a success alert
        echo "<script>alert('Plot added successfully.');</script>";
        header('location:property__admin.php');
    } else {
        // Error uploading image
        echo "<script>alert('Error uploading request.');</script>";
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
                            <!-- <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_self" class="btn btn-primary">Download Free</a> -->
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
                                    <label for="exampleInputtext1" class="form-label">Plot Name</label>
                                    <input type="text" name="plot_name" class="form-control" id="exampleInputtext1" aria-describedby="textHelp" required>
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

                                <div class="mb-3">
                                    <label for="size">Size (in sq.metres):</label>
                                    <input type="number" name="size" class="form-control" id="exampleInputtext1" aria-describedby="textHelp" min="50" max="500" placeholder="min 50 - max 500" required>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputtext1" class="form-label">Price</label>
                                    <input type="number" name="price" class="form-control" id="exampleInputtext1" aria-describedby="textHelp" required>
                                </div>

                                <div class="mb-3">
                                    <label for="propertyImage" class="form-label">Property Image</label>
                                    <input type="file" name="property_image" class="form-control" id="propertyImage" accept="image/*" required>
                                </div>

                                <button type="submit" name="submit" class="btn btn-outline-primary fs-4 mb-4 rounded-2">Add Plot</button>
                            </form>
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