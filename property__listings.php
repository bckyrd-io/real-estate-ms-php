<?php
session_start();
include_once('db.php'); // Adjust this path to your database connection script

// Fetch data from the "plots" table
$selectPlotsDataQuery = "SELECT * FROM plots";
$stmt = $conn->query($selectPlotsDataQuery);
$plotsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Process data for unique categories
$uniqueLocations = [];
$uniqueSizes = [];
$uniquePriceRanges = [];

foreach ($plotsData as $plot) {
    $location = strtolower(str_replace(' ', '-', $plot['location']));
    $size = ($plot['size'] <= 100) ? 'small' : 'medium'; // Modify this logic as needed
    $priceRange = ($plot['price'] <= 100000) ? 'low-price' : 'high-price'; // Modify this logic as needed

    $uniqueLocations[$location] = true;
    $uniqueSizes[$size] = true;
    $uniquePriceRanges[$priceRange] = true;
}

$uniqueLocations = array_keys($uniqueLocations);
$uniqueSizes = array_keys($uniqueSizes);
$uniquePriceRanges = array_keys($uniquePriceRanges);


// Submit plot application
if (isset($_GET['plot_id'])) {
    // Default status
    $user_id = $_SESSION['user_id'];
    $status = 'applied';
    $date = date("Y-m-d");
    $plot_id = $_GET['plot_id'];

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
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Real Estate Management System</title>
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
                        <h2>REAL-ESTATE</h2>
                        <!-- <img src="assets/images/logos/dark-logo.svg" width="180" alt="" /> -->
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar " data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link active" href="./property__listings.php" aria-expanded="false">
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
                            <a class="sidebar-link" href="./pay__calculation.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Calculator</span>
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

                    </ul>
                    <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
                        <div class="d-flex">
                            <div class="unlimited-access-title me-3">
                                <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Lets Go Home</h6>
                                <a href="index.php" target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Click</a>
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
                <!-- Filters -->
                <div class="filters-button-group mb-4">
                    <button class="button btn btn-outline-success" data-filter="*">Show all</button>
                    <!-- Location Filters -->
                    <?php foreach ($uniqueLocations as $location) : ?>
                        <button class="button btn btn-outline-success" data-filter=".<?php echo $location; ?>"><?php echo ucfirst($location); ?></button>
                    <?php endforeach; ?>

                    <!-- Size Filters -->
                    <?php foreach ($uniqueSizes as $size) : ?>
                        <button class="button btn btn-outline-success" data-filter=".<?php echo $size; ?>"><?php echo ucfirst($size); ?></button>
                    <?php endforeach; ?>

                    <!-- Price Range Filters -->
                    <?php foreach ($uniquePriceRanges as $priceRange) : ?>
                        <button class="button btn btn-outline-success" data-filter=".<?php echo $priceRange; ?>"><?php echo ucfirst($priceRange); ?></button>
                    <?php endforeach; ?>
                </div>

                <div class="row grid">
                    <?php foreach ($plotsData as $plot) : ?>
                        <?php
                        $locationClass = strtolower(str_replace(' ', '-', $plot['location']));
                        $sizeClass = ($plot['size'] <= 100) ? 'small' : 'medium';
                        $priceClass = ($plot['price'] <= 100000) ? 'low-price' : 'high-price';
                        ?>
                        <div class="col-sm-6 col-xl-4 element-item <?php echo $locationClass; ?> <?php echo $sizeClass; ?> <?php echo $priceClass; ?>">
                            <div class="card overflow-hidden rounded-2">
                                <img src="<?php echo $plot['image_path']; ?>" class="card-img-top" alt="Plot Image">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $plot['plot_name']; ?></h5>
                                    <p class="card-text">Location: <?php echo $plot['location']; ?></p>
                                    <p class="card-text">Size: <?php echo $plot['size']; ?> hectares</p>
                                    <p class="card-text">Price: Mwk<?php echo $plot['price']; ?></p>
                                    <div class="row">
                                        <a href="property__tour.php?id=<?php echo $plot['id']; ?>" target="_blank" class="btn btn-outline-primary mt-2">Tour Around</a>
                                        <a href="property__listings.php?plot_id=<?= $plot['id']; ?> " target="_blank" class="btn btn-primary mt-2">apply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>

        </div>
    </div>
    </div>


    <!-- Scripts -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="./assets/libs/isotope.pkgd.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sidebarmenu.js"></script>
    <script src="assets/js/app.min.js"></script>


    <script>
        $(document).ready(function() {
            // Initialize Isotope
            var $grid = $('.grid').isotope({
                itemSelector: '.element-item',
                layoutMode: 'fitRows'
            });

            // Filter items on button click
            $('.filters-button-group').on('click', 'button', function() {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
            });

            // Debugging: Reinitialize Isotope after a delay (e.g., 500 ms)
            setTimeout(function() {
                $grid.isotope('layout');
            }, 500);

            // Additional debugging: Print all class names of items
            $('.element-item').each(function() {
                console.log(this.className);
            });
        });
    </script>




</body>

</html>