<?php
require_once 'config.php';

try {
    $query = "SELECT 
                h.id,
                h.house_number,
                h.resident_name,
                h.phone,
                h.email,
                h.address,
                h.area,
                h.city,
                h.pin_code,
                h.qr_code,
                h.status,
                h.registered_date,
                COUNT(wc.id) as total_collections,
                MAX(wc.collection_date) as last_collection
              FROM households h
              LEFT JOIN waste_collections wc ON h.id = wc.household_id
              GROUP BY h.id
              ORDER BY h.registered_date DESC";
    
    $result = $conn->query($query);
    
    $households = [];
    while ($row = $result->fetch_assoc()) {
        $households[] = [
            'id' => (int)$row['id'],
            'houseNumber' => $row['house_number'],
            'residentName' => $row['resident_name'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'address' => $row['address'],
            'area' => $row['area'],
            'city' => $row['city'],
            'pinCode' => $row['pin_code'],
            'qrCode' => $row['qr_code'],
            'status' => $row['status'],
            'totalCollections' => (int)$row['total_collections'],
            'lastCollection' => $row['last_collection'],
            'registeredDate' => $row['registered_date']
        ];
    }
    
    sendResponse(true, 'Households retrieved successfully', $households);
    
} catch (Exception $e) {
    sendResponse(false, 'Error fetching households: ' . $e->getMessage());
}

$conn->close();
?>