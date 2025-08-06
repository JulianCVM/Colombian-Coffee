<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Modules\User\Domain\Model\User;

require_once '../../vendor/autoload.php';

header('Content-Type: application/json');

$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['user']) || !isset($input['pass'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Campos incompletos']);
    exit;
}

$email = $input['user'];
$password = $input['pass'];

$user = User::where('email', $email)->first();

if (!$user || !password_verify($password, $user->password)) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Credenciales inválidas']);
    exit;
}

// ✅ Generar token JWT
$payload = [
    'sub' => $user->id,
    'email' => $user->email,
    'iat' => time(),
    'exp' => time() + (60 * 60) // 1 hora
];

$secret = 'tu_clave_secreta_segura';
$jwt = JWT::encode($payload, $secret, 'HS256');

echo json_encode([
    'success' => true,
    'token' => $jwt,
    'user' => [
        'id' => $user->id,
        'nombre' => $user->nombre,
        'email' => $user->email
    ]
]);
