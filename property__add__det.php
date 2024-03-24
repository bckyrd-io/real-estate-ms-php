    <?php
    session_start();
    include_once('db.php');

    if (isset($_POST['submit'])) {
        // Get plot ID from the URL parameter
        $plotId = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // File upload handling
        $uploadDir = 'uploads/';  // Specify the directory for uploading images
        $uploadFile = $uploadDir . basename($_FILES['property_media']['name']);

        if ($plotId > 0 && move_uploaded_file($_FILES['property_media']['tmp_name'], $uploadFile)) {
            // Image uploaded successfully, proceed with database insertion

            // SQL query to insert media data
            $insertMediaQuery = "INSERT INTO plot_media (plot_id, media_type, media_path, description) VALUES (:plot_id, :media_type, :media_path, :description)";
            $stmt = $conn->prepare($insertMediaQuery);
            $mediaType = 'image'; // Assuming the uploaded file is an image
            $description = $_POST['description']; // Replace with actual description if available

            $stmt->bindParam(':plot_id', $plotId);
            $stmt->bindParam(':media_type', $mediaType);
            $stmt->bindParam(':media_path', $uploadFile);
            $stmt->bindParam(':description', $description);
            $stmt->execute();

            echo "<script>alert('Media added successfully.');</script>";
        } else {
            echo "<script>alert('Error uploading image or invalid plot ID.');</script>";
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
                                <a class="sidebar-link" href="./property__admin__approve.php" aria-expanded="false">
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
                                        <label for="propertyMedia" class="form-label">Property Video</label>
                                        <input type="file" name="property_media" class="form-control" id="propertyMedia" accept="image/*" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" class="form-control" id="description" rows="3" required></textarea>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-primary w-100 fs-4 mb-4 rounded-2">Add Media</button>
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