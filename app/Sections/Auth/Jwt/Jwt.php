<?php

namespace Sections\Auth\Jwt;

use Illuminate\Contracts\Auth\Authenticatable;
use Sections\User\User\Models\User;

class Jwt
{
    private ?bool  $authorized = null;
    private string $key_path;

    public function __construct(
        private readonly JwtHeader    $header = new JwtHeader(),
        private readonly JwtPayload   $payload = new JwtPayload(),
        private readonly JwtSignature $signature = new JwtSignature()
    ) {
        $this->key_path = base_path('app/Core/Keys/jwt.key');
    }

    public function createToken(Authenticatable $user, $remember = false): string|false
    {
        if (!$user instanceof User) {
            return false;
        }

        $this->header->setDecodedHeader(['algo' => 'sha256', 'type' => 'JWT']);
        $this->payload->setDecodedPayload([
            ...$user->toArray(),
            'exp' => time() + ($remember ? 2592000 : 86400),
        ]);

        $key = $this->getKey();
        if (!$key) {
            return false;
        }

        return $this->signature->create($this->header, $this->payload, $key);
    }

    public function setToken(string $token): ?self
    {
        $token = $this->getTokenAsArray($token);
        if (!$token || count($token) !== 3) {
            return null;
        }

        $this->header->setHeader($token[0]);
        $this->payload->setPayload($token[1]);
        $this->signature->setSignature($token[2]);

        return $this;
    }

    public function validate(): bool
    {
        if (!$this->header->validated() || !$this->payload->validated()) {
            return false;
        }

        $key = $this->getKey();
        if (!$key) {
            return false;
        }

        return $this->authorized = $this->signature->check($this->header, $this->payload, $key);
    }

    public function getPayload(): ?array
    {
        return $this->authorized === null && !$this->validate()
            ? null
            : $this->payload->getDecodedPayload();
    }

    private function getTokenAsArray(string $token): array
    {
        return explode('.', $token);
    }

    private function getKey(): ?string
    {
        return file_exists($this->key_path)
            ? file_get_contents($this->key_path)
            : null;
    }
}
