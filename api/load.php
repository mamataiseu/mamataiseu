<?php
session_start(['cookie_httponly' => true, 'cookie_samesite' => 'Lax']);
header('Content-Type: application/json');
require_once __DIR__ . '/../config.php';

try {
    $db   = getDB();
    $rows = $db->query('SELECT `key`, value FROM data_store')->fetchAll();
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error. Run install.php first.']);
    exit;
}

$result = [];
foreach ($rows as $row) {
    $result[$row['key']] = json_decode($row['value'], true);
}

echo json_encode($result);
