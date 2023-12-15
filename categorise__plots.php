<?php
session_start();
include_once('db.php'); // Ensure this path is correct

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
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
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

        <!-- Main wrapper -->
        <div class="body-wrapper">
            <!-- [Your existing header code here] -->

            <!-- Filters -->
            <div class="filters-button-group">
                <button class="btn btn-primary" data-filter="*">Show all</button>
                <button class="btn btn-primary" data-filter=".residential">Residential</button>
                <button class="btn btn-primary" data-filter=".commercial">Commercial</button>
                <!-- More buttons as needed -->
            </div>

            <!-- Search field -->
            <input type="text" id="quicksearch" placeholder="Search" class="form-control" />
            <!-- Gallery -->
            <div class="grid">
                <?php foreach ($plotsData as $plot) : ?>
                    <?php
                    // Check if 'category' key exists and assign a default value if not
                    $category = isset($plot['category']) ? strtolower($plot['category']) : 'uncategorized';
                    $imagePath = isset($plot['image_path']) ? $plot['image_path'] : 'path/to/default-image.jpg'; // Provide a default image path if not set
                    $plotName = $plot['plot_name'] ?? 'Unnamed Plot'; // Default to 'Unnamed Plot' if plot_name is not set
                    ?>
                    <div class="element-item <?php echo $category; ?>" data-category="<?php echo $category; ?>">
                        <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($plotName); ?>">
                        <p class="name"><?php echo htmlspecialchars($plotName); ?></p>
                        <!-- More property info here -->
                    </div>
                <?php endforeach; ?>
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
    <script src="https://unpkg.com/ag-grid-community/dist/ag-grid-community.min.noStyle.js"></script>

    <script>
        // init Isotope
        var $grid = $('.grid').imagesLoaded(function() {
            // init Isotope after all images have loaded
            $grid.isotope({
                itemSelector: '.element-item',
                layoutMode: 'fitRows',
            });
        });

        // use value of search field to filter
        var qsRegex;
        var $quicksearch = $('#quicksearch').keyup(debounce(function() {
            qsRegex = new RegExp($quicksearch.val(), 'gi');
            $grid.isotope({
                filter: function() {
                    return qsRegex ? $(this).text().match(qsRegex) : true;
                }
            });
        }, 200));

        // debounce so filtering doesn't happen every millisecond
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

        // bind filter buttons
        $('.filters-button-group').on('click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });
    </script>



</body>

</html>