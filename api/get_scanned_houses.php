<?php
require_once 'config.php';

try {
    // Get optional date filter
    $date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
    
    $query = "SELECT 
                wc.id,
                wc.collection_date,
                wc.waste_type,
                wc.weight_kg,
                wc.notes,
                h.id as household_id,
                h.house_number,
                h.resident_name,
                h.phone,
                h.address,
                h.area,
                h.qr_code,
                d.id as driver_id,
                d.name as driver_name,
                d.vehicle_number
              FROM waste_collections wc
              INNER JOIN households h ON wc.household_id = h.id
              INNER JOIN drivers d ON wc.driver_id = d.id
              WHERE DATE(wc.collection_date) = ?
              ORDER BY wc.collection_date DESC";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $date);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $collections = [];
    while ($row = $result->fetch_assoc()) {
        $collections[] = [
            'id' => (int)$row['id'],
            'collectionDate' => $row['collection_date'],
            'wasteType' => $row['waste_type'],
            'weightKg' => $row['weight_kg'] ? (float)$row['weight_kg'] : null,
            'notes' => $row['notes'],
            'household' => [
                'id' => (int)$row['household_id'],
                'houseNumber' => $row['house_number'],
                'residentName' => $row['resident_name'],
                'phone' => $row['phone'],
                'address' => $row['address'],
                'area' => $row['area'],
                'qrCode' => $row['qr_code']
            ],
            'driver' => [
                'id' => (int)$row['driver_id'],
                'name' => $row['driver_name'],
                'vehicleNumber' => $row['vehicle_number']
            ]
        ];
    }
    
    // Get summary statistics for the date
    $statsQuery = "SELECT 
                    COUNT(DISTINCT household_id) as houses_scanned,
                    COUNT(*) as total_collections,
                    SUM(weight_kg) as total_weight
                   FROM waste_collections 
                   WHERE DATE(collection_date) = ?";
    
    $stmt = $conn->prepare($statsQuery);
    $stmt->bind_param('s', $date);
    $stmt->execute();
    $statsResult = $stmt->get_result();
    $stats = $statsResult->fetch_assoc();
    
    sendResponse(true, 'Collections retrieved successfully', [
        'collections' => $collections,
        'stats' => [
            'date' => $date,
            'housesScanned' => (int)$stats['houses_scanned'],
            'totalCollections' => (int)$stats['total_collections'],
            'totalWeight' => $stats['total_weight'] ? (float)$stats['total_weight'] : 0
        ]
    ]);
    
} catch (Exception $e) {
    sendResponse(false, 'Error fetching collections: ' . $e->getMessage());
}

$conn->close();
?>