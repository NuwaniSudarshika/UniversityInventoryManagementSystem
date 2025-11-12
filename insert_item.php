<?php
// insert_item.php
header('Content-Type: application/json');
include 'db_connect.php';

// Read JSON data
$data = json_decode(file_get_contents("php://input"), true);

// Validate
if (!isset($data['faculty'], $data['itemName'], $data['itemCount'])) {
    echo json_encode(['success' => false, 'message' => 'Missing data']);
    exit;
}

$faculty = $data['faculty'];
$itemName = trim($data['itemName']);
$itemCount = intval($data['itemCount']);

// Match faculty to correct table
$facultyTables = [
    'science' => 'applied_items',
    'business' => 'business_items',
    'technology' => 'technology_items'
];

if (!array_key_exists($faculty, $facultyTables)) {
    echo json_encode(['success' => false, 'message' => 'Invalid faculty']);
    exit;
}

$tableName = $facultyTables[$faculty];

// Insert the item
$stmt = $conn->prepare("INSERT INTO `$tableName` (item_name, item_count) VALUES (?, ?)");
if ($stmt) {
    $stmt->bind_param("si", $itemName, $itemCount);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Execute error: ' . $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Prepare error: ' . $conn->error]);
}

$conn->close();
