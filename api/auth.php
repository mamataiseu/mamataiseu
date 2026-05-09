<?php
session_start([
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax',
]);
header('Content-Type: application/json');
require_once __DIR__ . '/../config.php';

$action = $_GET['action'] ?? '';
$body   = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $raw  = file_get_contents('php://input');
    $body = json_decode($raw, true) ?? [];
    if (!$action) $action = $body['action'] ?? '';
}

// ── GET me ────────────────────────────────────────────────────────────────────
if ($action === 'me') {
    echo json_encode(['user' => $_SESSION['p9_user'] ?? null]);
    exit;
}

// ── POST login ────────────────────────────────────────────────────────────────
if ($action === 'login') {
    $username = trim($body['username'] ?? '');
    $password = $body['password'] ?? '';
    if (!$username || !$password) {
        http_response_code(400);
        echo json_encode(['error' => 'Username and password are required.']);
        exit;
    }
    try {
        $db   = getDB();
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error. Is the database set up?']);
        exit;
    }
    if (!$user || !password_verify($password, $user['password'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid credentials.']);
        exit;
    }
    $safe = [
        'id'       => (int)$user['id'],
        'username' => $user['username'],
        'email'    => $user['email'],
        'role'     => $user['role'],
    ];
    $_SESSION['p9_user'] = $safe;
    echo json_encode(['user' => $safe]);
    exit;
}

// ── POST register ─────────────────────────────────────────────────────────────
if ($action === 'register') {
    $username = trim($body['username'] ?? '');
    $email    = trim($body['email']    ?? '');
    $password = $body['password']      ?? '';
    if (!$username || !$email || !$password) {
        http_response_code(400);
        echo json_encode(['error' => 'All fields are required.']);
        exit;
    }
    if (strlen($password) < 4) {
        http_response_code(400);
        echo json_encode(['error' => 'Password must be at least 4 characters.']);
        exit;
    }
    try {
        $db   = getDB();
        $stmt = $db->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            http_response_code(409);
            echo json_encode(['error' => 'Username already taken.']);
            exit;
        }
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $db->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')")
           ->execute([$username, $email, $hash]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error.']);
        exit;
    }
    echo json_encode(['success' => true]);
    exit;
}

// ── POST logout ───────────────────────────────────────────────────────────────
if ($action === 'logout') {
    $_SESSION = [];
    session_destroy();
    echo json_encode(['success' => true]);
    exit;
}

http_response_code(400);
echo json_encode(['error' => 'Unknown action.']);
