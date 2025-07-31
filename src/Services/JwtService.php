<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

final class JwtService
{
    public static function verify(string $token): object
    {
        $alg = $_ENV['JWT_ALG'] ?? 'HS256';
        return JWT::decode($token, new Key($_ENV['JWT_SECRET'], $alg));
    }

    public static function sign(array $data, int $expireInSeconds = 3600): string
    {
        $payload = array_merge($data, [
            'exp' => time() + $expireInSeconds,
            'iat' => time(),
        ]);

        $alg = $_ENV['JWT_ALG'] ?? 'HS256';
        return JWT::encode($payload, $_ENV['JWT_SECRET'], $alg);
    }
}
