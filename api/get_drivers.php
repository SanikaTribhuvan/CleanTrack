<?php
require_once 'config.php';

try {
    $query = "SELECT 
                d.id,
                d.name,
                d.phone,
                d.email,
                d.license_number,
                d.vehicle_number,
                d.status,
                d.created_at,
                u.username,
                COUNT(wc.id) as total_collections
              FROM drivers d
              LEFT JOIN users u ON d.user_id = u.id
              LEFT JOIN waste_collections wc ON d.id = wc.driver_id
              GROUP BY d.id
              ORDER BY d.created_at DESC";
    
    $result = $conn->query($query);
    
    $drivers = [];
    while ($row = $result->fetch_assoc()) {
        $drivers[] = [
            'id' => (int)$row['id'],
            'name' => $row['name'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'licenseNumber' => $row['license_number'],
            'vehicleNumber' => $row['vehicle_number'],
            'status' => $row['status'],
            'username' => $row['username'],
            'totalCollections' => (int)$row['total_collections'],
            'createdAt' => $row['created_at']
        ];
    }
    
    sendResponse(true, 'Drivers retrieved successfully', $drivers);
    
} catch (Exception $e) {
    sendResponse(false, 'Error fetching drivers: ' . $e->getMessage());
}

$conn->close();
?>