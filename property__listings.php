<?php
session_start();
include_once('db.php'); // Assuming the path to your database connection script is 'serve/db.php'

// Fetch data from the "plots" table
$selectPlotsDataQuery = "SELECT * FROM plots";
$stmt = $conn->query($selectPlotsDataQuery);
$plotsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Real Estate Ms</title>
    <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <!-- Include Isotope and ImagesLoaded -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.4/imagesloaded.pkgd.min.js"></script>
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
                <!-- Filters -->
                <div class="filters-button-group mb-4">
                    <button class="btn btn-outline-primary" data-filter="*">Show all</button>
                    <button class="btn btn-outline-primary" data-filter=".residential">Residential</button>
                    <button class="btn btn-outline-primary" data-filter=".commercial">Commercial</button>
                    <button class="btn btn-outline-primary" data-filter=".small">Small</button>
                    <button class="btn btn-outline-primary" data-filter=".medium">Medium</button>
                    <button class="btn btn-outline-primary" data-filter=".large">Large</button>
                    <!-- Add more filter buttons as needed -->
                </div>

                <!-- Search field -->
                <input type="text" id="quicksearch" placeholder="Search" class="form-control mb-4" />

                <!-- Gallery -->
                <!-- <div class="grid">
                    <?php foreach ($plotsData as $plot) : ?>
                        <?php
                        $category = isset($plot['category']) ? strtolower($plot['category']) : 'uncategorized';
                        $sizeClass = 'size-' . strtolower($plot['size']);
                        $locationClass = 'location-' . strtolower(str_replace(' ', '-', $plot['location']));
                        $plotName = $plot['plot_name'] ?? 'Unnamed Plot';
                        ?>
                        <div class="element-item <?php echo $category; ?> <?php echo $sizeClass; ?> <?php echo $locationClass; ?>" data-category="<?php echo $category; ?>">
                            <h3><?php echo htmlspecialchars($plotName); ?></h3>
                            <p>Size: <?php echo htmlspecialchars($plot['size']); ?></p>
                            <p>Location: <?php echo htmlspecialchars($plot['location']); ?></p>
                            <p>Price: <?php echo htmlspecialchars($plot['price']); ?></p>
                           
                        </div>
                    <?php endforeach; ?>
                </div> -->


                <div class="row">
                    <?php foreach ($plotsData as $plot) : ?>
                        <div class="col-sm-6 col-xl-4">
                            <div class="card overflow-hidden rounded-2">
                                <div class="position-relative">
                                    <a href="javascript:void(0)"><img src="<?php echo $plot['image_path']; ?>" class="card-img-top rounded-0" alt="Plot Image"></a>
                                    <a href="javascript:void(0)" class="bg-success rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart">
                                        <i class="ti ti-basket fs-4"></i>
                                    </a>
                                </div>
                                <div class="card-body pt-3 p-4">
                                    <h6 class="fw-semibold fs-4"><?php echo $plot['plot_name']; ?><span class="ms-2 fw-normal text-muted fs-3">- <?php echo $plot['location']; ?></span></h6>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="fw-semibold fs-4 mb-0">Mwk<?php echo $plot['price']; ?> <span class="ms-2 fw-normal text-muted fs-3"> - <?php echo $plot['size']; ?> hectares</span></h6>
                                    </div>
                                    <div class="row">
                                        <a href="property__virtual.php?id=<?php echo $plot['id']; ?>" target="_blank" class="btn btn-outline-primary mt-2">Virtual Tour</a>
                                        <button type="button" class=" btn btn-primary mt-2" data-plot-id="<?php echo $plot['id']; ?>">Schedule Tour</button>
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
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sidebarmenu.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="https://unpkg.com/ag-grid-community/dist/ag-grid-community.min.noStyle.js"></script>

    <script>
        // Isotope filter and search implementation
        var $grid = $('.grid').imagesLoaded(function() {
            $grid.isotope({
                itemSelector: '.element-item',
                layoutMode: 'fitRows',
            });
        });

        var qsRegex;
        var $quicksearch = $('#quicksearch').keyup(debounce(function() {
            qsRegex = new RegExp($quicksearch.val(), 'gi');
            $grid.isotope({
                filter: function() {
                    return qsRegex ? $(this).text().match(qsRegex) : true;
                }
            });
        }, 200));

        function debounce(fn, threshold) {
            var timeout;
            return function debounced() {
                if (timeout) {
                    clearTimeout(timeout);
                }

                function delayed() {
                    fn();
                    timeout = null;
                }
                timeout = setTimeout(delayed, threshold || 100);
            };
        }

        $('.filters-button-group').on('click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });
    </script>


</body>

</html>