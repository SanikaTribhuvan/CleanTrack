<?php
require_once 'config.php';

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);

// If data is not JSON, try getting from POST
if (!$data) {
    $data = $_POST;
}

// Validate required fields
$required = ['house_number', 'resident_name', 'phone', 'address', 'area'];
$missing = validateRequired($required, $data);

if (!empty($missing)) {
    sendResponse(false, 'Missing required fields: ' . implode(', ', $missing));
}

// Sanitize inputs
$houseNumber = sanitizeInput($data['house_number']);
$residentName = sanitizeInput($data['resident_name']);
$phone = sanitizeInput($data['phone']);
$email = isset($data['email']) ? sanitizeInput($data['email']) : null;
$address = sanitizeInput($data['address']);
$area = sanitizeInput($data['area']);
$city = isset($data['city']) ? sanitizeInput($data['city']) : 'Ahilyanagar';
$pinCode = isset($data['pin_code']) ? sanitizeInput($data['pin_code']) : null;
$latitude = isset($data['latitude']) ? floatval($data['latitude']) : null;
$longitude = isset($data['longitude']) ? floatval($data['longitude']) : null;

// Validate phone number format
if (!preg_match('/^[0-9]{10}$/', $phone)) {
    sendResponse(false, 'Invalid phone number. Must be 10 digits.');
}

// Generate unique QR code
$qrCode = 'QR_' . strtoupper($area) . '_' . $houseNumber . '_' . uniqid();

// Check if house number already exists in the area
$checkQuery = "SELECT id FROM households WHERE house_number = ? AND area = ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param('ss', $houseNumber, $area);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    sendResponse(false, 'House number already exists in this area');
}

try {
    // Insert household
    $insertQuery = "INSERT INTO households 
                    (house_number, resident_name, phone, email, address, area, city, pin_code, qr_code, latitude, longitude, status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'ACTIVE')";
    
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param('sssssssssdd', 
        $houseNumber, $residentName, $phone, $email, $address, 
        $area, $city, $pinCode, $qrCode, $latitude, $longitude
    );
    
    $stmt->execute();
    $householdId = $conn->insert_id;
    
    sendResponse(true, 'Household registered successfully', [
        'householdId' => $householdId,
        'qrCode' => $qrCode,
        'houseNumber' => $houseNumber,
        'area' => $area
    ]);
    
} catch (Exception $e) {
    sendResponse(false, 'Error registering household: ' . $e->getMessage());
}

$conn->close();
?>