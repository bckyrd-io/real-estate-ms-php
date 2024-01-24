<?php
include_once('db.php');

header('Content-Type: application/json');

try {
    // Fetch total number of plots sold per location
    $plotsQuery = "SELECT location, COUNT(*) as total_sold FROM plots GROUP BY location";
    $plotsStmt = $conn->prepare($plotsQuery);
    $plotsStmt->execute();
    $plotsData = $plotsStmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch the status count from the usersonplot table
    $usersonplotQuery = "SELECT status, COUNT(*) as total_status FROM usersonplot GROUP BY status";
    $usersonplotStmt = $conn->prepare($usersonplotQuery);
    $usersonplotStmt->execute();
    $usersonplotData = $usersonplotStmt->fetchAll(PDO::FETCH_ASSOC);

    // Assume that 'paid' status in usersonplot indicates a completed sale
    $earningsQuery = "
        SELECT SUM(plots.price) as total_earnings, DATE_FORMAT(usersonplot.date, '%Y-%m') as month 
        FROM usersonplot
        JOIN plots ON usersonplot.plot_id = plots.id
        WHERE usersonplot.status = 'paid'
        GROUP BY DATE_FORMAT(usersonplot.date, '%Y-%m')
    ";
    $earningsStmt = $conn->prepare($earningsQuery);
    $earningsStmt->execute();
    $earningsData = $earningsStmt->fetchAll(PDO::FETCH_ASSOC);

    // Combine data for response
    $response = [
        'plotsData' => $plotsData,
        'usersonplotData' => $usersonplotData,
        'earningsData' => $earningsData
    ];

    echo json_encode($response);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
