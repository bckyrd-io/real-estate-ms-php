<?php

require __DIR__ . "/vendor/autoload.php";

$stripe_secret_key = "sk_test_51NJc48IJv2NdkOsStIGmR69KKDffSapdj5d19uFkimzAvFKvW36MoN4e8PXzKyAFiV6TGn23TSerIlvxvSpe9TqH00p0b93AuS";

\Stripe\Stripe::setApiKey($stripe_secret_key);

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/success.php",
    "cancel_url" => "http://localhost/index.php",
    "locale" => "auto",
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "usd",
                "unit_amount" => 200,
                "product_data" => [
                    "name" => "T-shirt"
                ]
            ]
        ],
        [
            "quantity" => 2,
            "price_data" => [
                "currency" => "usd",
                "unit_amount" => 100,
                "product_data" => [
                    "name" => "Hat"
                ]
            ]
        ]        
    ]
]);

http_response_code(303);
header("Location: " . $checkout_session->url);