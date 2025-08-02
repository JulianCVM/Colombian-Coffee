<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
    private static function getKey(): string
    {
        return $_ENV['JWT_SECRET'] ?? 'clave-secreta-temporal-para-desarrollo';
    }

    private static function getAlgorithm(): string
    {
        return 'HS256';
    }

    public static function sign(array $payload): string
    {
        $now = time();
        $exp = $now + (24 * 60 * 60); // 24 horas

        $fullPayload = array_merge($payload, [
            'iat' => $now,  // issued at
            'exp' => $exp,  // expiration
            'iss' => 'coffee-api' // issuer
        ]);

        return JWT::encode($fullPayload, self::getKey(), self::getAlgorithm());
    }

    public static function verify(string $token): object
    {
        try {
            return JWT::decode($token, new Key(self::getKey(), self::getAlgorithm()));
        } catch (\Exception $e) {
            throw new \Exception('Token inválido: ' . $e->getMessage(), 401);
        }
    }
}