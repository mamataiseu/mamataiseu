<?php
session_start(['cookie_httponly' => true, 'cookie_samesite' => 'Lax']);
header('Content-Type: application/json');
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../install.php';

// Admin only
if (empty($_SESSION['p9_user']) || $_SESSION['p9_user']['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Forbidden.']);
    exit;
}

try {
    $db = getDB();
    resetDefaults($db);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Reset failed: ' . $e->getMessage()]);
}
