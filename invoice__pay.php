<?php
session_start();
include_once('db.php'); // Assuming the path to your database connection script is '/db.php'
$user_id = 1;

// Fetch data from the database
$selectInvoiceDataQuery = "
    SELECT u.username, u.email, p.plot_name, p.location, p.size, p.price, pay.amount, pay.payment_date
    FROM users u
    JOIN payments pay ON u.id = pay.user_id
    JOIN plots p ON pay.plot_id = p.id
    WHERE u.id = $user_id";
$stmt = $conn->query($selectInvoiceDataQuery);
$invoiceData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate total
$total = 0;
foreach ($invoiceData as $data) {
    $total += $data['amount'];
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
                                        <a href="serve/logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
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
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Plot Name</th>
                                    <th>Location</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Paid Amount</th>
                                    <th>Payment Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($invoiceData as $data) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($data['plot_name']); ?></td>
                                        <td><?php echo htmlspecialchars($data['location']); ?></td>
                                        <td><?php echo htmlspecialchars($data['size']); ?></td>
                                        <td><?php echo htmlspecialchars($data['price']); ?></td>
                                        <td><?php echo htmlspecialchars($data['amount']); ?></td>
                                        <td><?php echo htmlspecialchars($data['payment_date']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="6">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong>Total Amount Due: MWK <?php echo htmlspecialchars(number_format($total, 2)); ?></strong>
                                            <form action="checkout_process.php" method="POST">
                                                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                                                <button type="submit" class="btn btn-outline-primary">Payment</button>
                                            </form>
                                        </div>
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
    <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="assets/js/dashboard.js"></script>
</body>

</html>