<?php
session_start();
include_once('db.php'); // Assuming the path to your database connection script is 'serve/db.php'


require __DIR__ . "/vendor/autoload.php";

$stripe_secret_key = "sk_test_51NJc48IJv2NdkOsStIGmR69KKDffSapdj5d19uFkimzAvFKvW36MoN4e8PXzKyAFiV6TGn23TSerIlvxvSpe9TqH00p0b93AuS";

\Stripe\Stripe::setApiKey($stripe_secret_key);


$_SESSION['payment_amount'] = '';
$_SESSION['user_id'] = '';
$amount = '';
if (isset($_POST['checkout'])) {
    // Convert amount to integer and ensure it's in cents for USD
    $amount = intval($_POST['payment_amount']); // Multiplying by 100 to convert to cents
    $_SESSION['payment_amount'] = $amount;
    $_SESSION['user_id'] = $_POST['user_id'];

    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => "http://localhost/real__estate/checkout__process.php?checkout_pay='paid'",
        "cancel_url" => "http://localhost/index.php",
        "locale" => "auto",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "usd",
                    "unit_amount" => $amount,
                    "product_data" => [
                        "name" => "Property"
                    ]
                ]
            ]
        ]
    ]);

    http_response_code(303);
    header("Location: " . $checkout_session->url);
}






if (isset($_GET['checkout_pay'])) {
    $plot_id = 1;
    $payment_date = date('Y-m-d');
    $user_id = 1;
    // $user_id = $_SESSION['user_id'];
    $payment_amount = $_SESSION['payment_amount'];
    $payment_amount = 12000;
    // Insert payment details into database
    $insertPaymentQuery = "INSERT INTO payments (user_id, plot_id, amount, payment_date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertPaymentQuery);
    $stmt->execute([$user_id, $plot_id, $payment_amount, $payment_date]);
    $stmt->execute([$user_id, $plot_id, $payment_amount, $payment_date]);
    // Destroy all session
    session_destroy();

    echo "<script>alert('Payment successful! Redirecting to invoice page...'); window.location.href='invoice__pay.php';</script>";
} else {
    echo "<script>alert('Payment failed or was cancelled.'); window.location.href='index.php';</script>";
}
