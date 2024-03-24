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
                <div class="card mb-0">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <strong>How do I search for properties?</strong><br>
                                        You can search for properties using our advanced search feature, which allows you to filter properties based on location, price range, property type, and more.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Can I filter properties based on specific criteria?</strong><br>
                                        Yes, you can filter properties based on various criteria such as price, number of bedrooms, bathrooms, property type, amenities, and more to find exactly what you're looking for.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>How do I schedule a property viewing?</strong><br>
                                        Once you find a property you're interested in, you can easily schedule a viewing by contacting the property agent or using our online booking system, if available.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>What payment options are available for purchasing a property?</strong><br>
                                        We offer various payment options depending on the property and the seller's preferences. Common payment methods include bank transfers, checks, and online payment platforms.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>How do I list my property for sale or rent on your platform?</strong><br>
                                        Listing your property on our platform is easy. Simply sign up as a seller, provide the necessary details about your property, upload photos, and set your desired price and terms. Our team will review your listing and make it live once approved.
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sidebarmenu.js"></script>
    <script src="assets/js/app.min.js"></script>
</body>

</html>