<?php
require_once 'config.php';

try {
    // Get total active houses
    $totalQuery = "SELECT COUNT(*) as total FROM households WHERE status = 'ACTIVE'";
    $totalResult = $conn->query($totalQuery);
    $totalHouses = $totalResult->fetch_assoc()['total'];
    
    // Get houses scanned today
    $scannedQuery = "SELECT COUNT(DISTINCT household_id) as scanned 
                     FROM waste_collections 
                     WHERE DATE(collection_date) = CURDATE()";
    $scannedResult = $conn->query($scannedQuery);
    $scannedToday = $scannedResult->fetch_assoc()['scanned'];
    
    // Calculate remaining houses
    $remainingToday = $totalHouses - $scannedToday;
    
    // Get total active drivers
    $driversQuery = "SELECT COUNT(*) as drivers FROM drivers WHERE status = 'ACTIVE'";
    $driversResult = $conn->query($driversQuery);
    $activeDrivers = $driversResult->fetch_assoc()['drivers'];
    
    // Get total collections this week
    $weekQuery = "SELECT COUNT(*) as collections 
                  FROM waste_collections 
                  WHERE YEARWEEK(collection_date) = YEARWEEK(CURDATE())";
    $weekResult = $conn->query($weekQuery);
    $collectionsThisWeek = $weekResult->fetch_assoc()['collections'];
    
    sendResponse(true, 'Statistics retrieved successfully', [
        'totalHouses' => (int)$totalHouses,
        'scannedToday' => (int)$scannedToday,
        'remainingToday' => (int)$remainingToday,
        'activeDrivers' => (int)$activeDrivers,
        'collectionsThisWeek' => (int)$collectionsThisWeek
    ]);
    
} catch (Exception $e) {
    sendResponse(false, 'Error fetching statistics: ' . $e->getMessage());
}

$conn->close();
?>