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
                            <form id="priceCalculator">
                                <div class="form-group mb-3">
                                    <label for="location">Location:</label>
                                    <select class="form-control" name="location" id="location">
                                        <!-- Add more options as needed -->
                                        <option value="town">Commecial Site</option>
                                        <option value="country">Residential Site</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="propertyType">Property Type:</label>
                                    <select class="form-control" name="propertyType" id="propertyType">
                                        <!-- Example property types, modify as needed -->
                                        <option value="apartment">Apartment</option>
                                        <option value="house">House</option>
                                        <option value="land">Land</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="size">Size (in sq.metres):</label>
                                    <input type="number" class="form-control" name="size" id="size" min="50" max="500" placeholder="Enter From 50 - 500 Square Metres" required>
                                    <!-- <input type="number" class="form-control" name="size" id="size" min="1" required> -->
                                </div>

                                <!-- Additional dropdowns can be added here for more factors -->

                                <button type="button" class="btn btn-outline-primary" onclick="calculatePrice()">Calculate Price</button>
                                <p class="mt-3 text-primary">Total Price: $ <span id="totalPrice">0</span></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ... (rest of the body content remains unchanged) ... -->

        </div>
    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sidebarmenu.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="assets/js/dashboard.js"></script>
    
    <script>
  // Function to calculate the estimated total price
  function calculatePrice() {
    var size = parseFloat($('#size').val()) || 0;

    // Ensure size is within a valid range (300-500 sq metres)
    if (size < 50 || size > 500) {
      alert("Please enter a valid size between 50 and 150 sq metres.");
      return;
    }

    var location = $('#location').val();
    var propertyType = $('#propertyType').val();

    // Get base price based on property type (adjusted based on average market data would be ideal)
    var basePrice = getBasePrice(propertyType);

    // Get location multiplier based on location (consider using a location API for more accurate data)
    var locationMultiplier = getLocationMultiplier(location);

    // Calculate total price using base price, size, and location multiplier
    var totalPrice = basePrice * size * locationMultiplier;

    // Display the formatted total price on the webpage
    $('#totalPrice').text(totalPrice.toFixed(2));
  }

  // Function to assign a base price based on property type (replace with actual market data)
  function getBasePrice(propertyType) {
    switch (propertyType) {
      case 'apartment':
        // Consider researching average price per sq metres for apartments in your target market
        return 150; // Placeholder value, replace with a more accurate base price
      case 'house':
        // Consider researching average price per sq metres for houses in your target market  
        return 200; // Placeholder value, replace with a more accurate base price
      case 'land':
        // Consider researching average price per sq metres for land in your target market  
        return 100; // Placeholder value, replace with a more accurate base price
      default:
        return 100;
    }
  }

  // Function to assign a location multiplier (consider using real estate data based on zip codes) 
  function getLocationMultiplier(location) {
    switch (location) {
      case 'town':
        // Ideal: Use real estate data to determine a location multiplier for towns in your target market
        return 1.2; // Placeholder value, replace with a more data-driven multiplier
      case 'country':
        // Ideal: Use real estate data to determine a location multiplier for rural areas in your target market
        return 1.5; // Placeholder value, replace with a more data-driven multiplier
      case 'locationC':
        // Ideal: Use real estate data to determine a location multiplier for locationC in your target market
        return 1.8; // Placeholder value, replace with a more data-driven multiplier
      default:
        return 1.0;
    }
  }
</script>

</body>

</html>