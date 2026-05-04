<?php
$conn = new mysqli('localhost', 'root', '', 'photographybymonali');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$tables = [];
$res = $conn->query("SHOW TABLES");
while($row = $res->fetch_array()) {
    $tableName = $row[0];
    
    // Get Structure
    $struct = [];
    $s_res = $conn->query("DESCRIBE $tableName");
    while($s_row = $s_res->fetch_assoc()) {
        $struct[] = $s_row;
    }
    
    // Get 5 Dummy Data
    $data = [];
    $d_res = $conn->query("SELECT * FROM $tableName LIMIT 5");
    while($d_row = $d_res->fetch_assoc()) {
        $data[] = $d_row;
    }
    
    $tables[$tableName] = [
        'structure' => $struct,
        'data' => $data
    ];
}

header('Content-Type: application/json');
echo json_encode($tables, JSON_PRETTY_PRINT);
?>
