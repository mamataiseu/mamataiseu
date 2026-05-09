<?php
session_start(['cookie_httponly' => true, 'cookie_samesite' => 'Lax']);
header('Content-Type: application/json');
require_once __DIR__ . '/../config.php';

// Require a valid session to write
if (empty($_SESSION['p9_user'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized. Please sign in.']);
    exit;
}

$body  = json_decode(file_get_contents('php://input'), true) ?? [];
$key   = $body['key']   ?? '';
$value = $body['value'] ?? null;

if (!$key) {
    http_response_code(400);
    echo json_encode(['error' => 'Key is required.']);
    exit;
}

// Theme is stored client-side only — nothing to do
if ($key === 'power9_theme') {
    echo json_encode(['success' => true]);
    exit;
}

// Sensitive keys only writable by admin
$adminOnlyKeys = ['power9_users'];
if (in_array($key, $adminOnlyKeys) && $_SESSION['p9_user']['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Forbidden.']);
    exit;
}

try {
    $db = getDB();
    $db->prepare("REPLACE INTO data_store (`key`, value) VALUES (?, ?)")
       ->execute([$key, json_encode($value, JSON_UNESCAPED_UNICODE)]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error.']);
    exit;
}

echo json_encode(['success' => true]);
