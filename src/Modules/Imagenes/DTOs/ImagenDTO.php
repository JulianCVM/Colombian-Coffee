<?php

namespace App\Modules\Imagenes\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

// DTO para manejar la data de una imagen
class ImagenDTO
{
    public function __construct(
        public readonly string $nombre,
        public readonly string $contenidoBase64 // contenido en base64 para facilitar transporte desde el frontend
    ) {
        $this->validateData($nombre, $contenidoBase64);
    }

    private function validateData(string $nombre, string $contenidoBase64): void
    {
        try {
            v::stringType()->notEmpty()->length(3, 255)->check($nombre);
            v::stringType()->notEmpty()->base64()->check($contenidoBase64);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException($e->getFullMessage());
        }
    }

    // Convertir DTO a array
    public function toArrayMapper(): array
    {
        return [
            'nombre' => $this->nombre,
            'contenido' => base64_decode($this->contenidoBase64) // lo guardas como BLOB
        ];
    }

    // Crear DTO desde array (por ejemplo desde Eloquent o un POST)
    public static function fromArrayMapper(array $data): self
    {
        return new self(
            $data['nombre'] ?? '',
            isset($data['contenido']) ? base64_encode($data['contenido']) : ''
        );
    }
}
