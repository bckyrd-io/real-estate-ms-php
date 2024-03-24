<?php
session_start();
include_once('db.php'); // Assuming the path to your database connection script is 'serve/db.php'


require __DIR__ . "/vendor/autoload.php";
$stripe_secret_key = "sk_test_51NJc48IJv2NdkOsStIGmR69KKDffSapdj5d19uFkimzAvFKvW36MoN4e8PXzKyAFiV6TGn23TSerIlvxvSpe9TqH00p0b93AuS";
\Stripe\Stripe::setApiKey($stripe_secret_key);


/**
 * for your pc ports use this.
 */
// "success_url" => "http://localhost:7882/real-estate/checkout__process.php?user_id=$user_id ",
// "cancel_url" => "http://localhost:7882/real-estate/invoice__pay.php",
/**
 * for normal pc use this 
 */
// "success_url" => "http://localhost/real-estate/checkout__process.php?user_id=$user_id ",
// "cancel_url" => "http://localhost/real-estate/invoice__pay.php",


if (isset($_POST['checkout'])) {
    // Convert amount to integer and ensure it's in cents for USD
    $payment_amount = $_POST['payment_amount'] * 100;
    $user_id = $_POST['user_id'];

    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => "http://localhost:7882/real-estate/checkout__process.php?user_id=$user_id ",
        "cancel_url" => "http://localhost:7882/real-estate/invoice__pay.php",
        "locale" => "auto",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "usd",
                    "unit_amount" => $payment_amount,
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


if (isset($_GET['user_id'])) {
    $payment_date = date('Y-m-d');
    $status = 'paid';
    $user_id = $_GET['user_id'];

    // Insert payment details into database
    $insertPaymentQuery = "INSERT INTO payments (user_id, payment_date) VALUES (?, ?)";
    $stmt = $conn->prepare($insertPaymentQuery);
    $stmt->execute([$user_id, $payment_date]);

    $updateQuery = "UPDATE usersonplot SET status = :status WHERE user_id = :user_id";
    $stmtUpdate = $conn->prepare($updateQuery);
    $stmtUpdate->bindParam(':status', $status);
    $stmtUpdate->bindParam(':user_id', $user_id);
    $stmtUpdate->execute();

    echo "<script>alert('Payment successful! Redirecting to invoice page...'); window.location.href='invoice__pay.php';</script>";
}
