<?php
require_once 'config.php';

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);

// If data is not JSON, try getting from POST
if (!$data) {
    $data = $_POST;
}

// Validate required fields
$required = ['name', 'phone', 'license_number', 'vehicle_number'];
$missing = validateRequired($required, $data);

if (!empty($missing)) {
    sendResponse(false, 'Missing required fields: ' . implode(', ', $missing));
}

// Sanitize inputs
$name = sanitizeInput($data['name']);
$phone = sanitizeInput($data['phone']);
$email = isset($data['email']) ? sanitizeInput($data['email']) : null;
$licenseNumber = sanitizeInput($data['license_number']);
$vehicleNumber = sanitizeInput($data['vehicle_number']);
$username = isset($data['username']) ? sanitizeInput($data['username']) : strtolower(str_replace(' ', '', $name));
$password = isset($data['password']) ? $data['password'] : 'driver123';

// Validate phone number format
if (!preg_match('/^[0-9]{10}$/', $phone)) {
    sendResponse(false, 'Invalid phone number. Must be 10 digits.');
}

// Check if license number already exists
$checkQuery = "SELECT id FROM drivers WHERE license_number = ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param('s', $licenseNumber);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    sendResponse(false, 'Driver with this license number already exists');
}

try {
    // Start transaction
    $conn->begin_transaction();
    
    // Create user account
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $userQuery = "INSERT INTO users (username, password, role) VALUES (?, ?, 'DRIVER')";
    $stmt = $conn->prepare($userQuery);
    $stmt->bind_param('ss', $username, $hashedPassword);
    $stmt->execute();
    $userId = $conn->insert_id;
    
    // Insert driver
    $driverQuery = "INSERT INTO drivers (user_id, name, phone, email, license_number, vehicle_number, status) 
                    VALUES (?, ?, ?, ?, ?, ?, 'ACTIVE')";
    $stmt = $conn->prepare($driverQuery);
    $stmt->bind_param('isssss', $userId, $name, $phone, $email, $licenseNumber, $vehicleNumber);
    $stmt->execute();
    $driverId = $conn->insert_id;
    
    // Commit transaction
    $conn->commit();
    
    sendResponse(true, 'Driver registered successfully', [
        'driverId' => $driverId,
        'username' => $username,
        'tempPassword' => $password
    ]);
    
} catch (Exception $e) {
    $conn->rollback();
    sendResponse(false, 'Error registering driver: ' . $e->getMessage());
}

$conn->close();
?>