<?php
include_once('db.php');

header('Content-Type: application/json');

try {
    // Fetch total number of plots sold per location
    $plotsQuery = "SELECT location, COUNT(*) as total_sold FROM plots GROUP BY location";
    $plotsStmt = $conn->query($plotsQuery);
    $plotsData = $plotsStmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch the status count from the usersonplot table
    $usersonplotQuery = "SELECT status, COUNT(*) as total_status FROM usersonplot GROUP BY status";
    $usersonplotStmt = $conn->query($usersonplotQuery);
    $usersonplotData = $usersonplotStmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch total payments received per month
    $earningsQuery = "SELECT SUM(amount) as total_earnings, DATE_FORMAT(payment_date, '%Y-%m') as month FROM payments GROUP BY DATE_FORMAT(payment_date, '%Y-%m')";
    $earningsStmt = $conn->query($earningsQuery);
    $earningsData = $earningsStmt->fetchAll(PDO::FETCH_ASSOC);

    // Combine data for response
    $response = [
        'plotsData' => $plotsData,
        'usersonplotData' => $usersonplotData,
        'earningsData' => $earningsData // Add this line
    ];

    echo json_encode($response);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
