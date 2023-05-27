<?php

namespace Sections\Auth\Jwt;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class JwtGuard implements StatefulGuard
{
    use GuardHelpers;

    private Request          $request;
    private ?Authenticatable $last_attempted;

    public function __construct(UserProvider $provider, Request $request)
    {
        $this->provider = $provider;
        $this->request = $request;
    }

    public function user(): ?Authenticatable
    {
        if ($this->user !== null) {
            return $this->user;
        }

        $token = $this->request->bearerToken();
        $jwt = new Jwt();

        if (!$token || !($payload = $jwt->setToken($token)?->getPayload())) {
            return null;
        }

        return $this->user = $this->provider->retrieveById($payload['id']);
    }

    public function validate(array $credentials = []): bool
    {
        $user = $this->provider->retrieveByCredentials($credentials);

        return $this->hasValidCredentials($user, $credentials);
    }

    public function check(): bool
    {
        return $this->user() !== null;
    }

    public function guest(): bool
    {
        return !$this->check();
    }

    public function id(): mixed
    {
        return $this->user?->getAuthIdentifier();
    }

    public function hasUser(): bool
    {
        return $this->user !== null;
    }

    public function setUser(Authenticatable $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function attempt(array $credentials = [], $remember = false): string|false
    {
        $this->last_attempted = $user = $this->provider->retrieveByCredentials($credentials);

        return $this->hasValidCredentials($user, $credentials)
            ? $this->login($user, $remember)
            : false;
    }

    public function once(array $credentials = []): bool
    {
        if ($this->validate($credentials)) {
            $this->setUser($this->last_attempted);
            return true;
        }

        return false;
    }

    public function login(Authenticatable $user, $remember = false): string|false
    {
        $jwt = new Jwt();
        $token = $jwt->createToken($user, $remember);
        if (!$token) {
            return false;
        }

        $this->setUser($user);
        return $token;
    }

    public function loginUsingId($id, $remember = false): string|false
    {
        $user = $this->provider->retrieveById($id);
        return $user !== null
            ? $this->login($user, $remember)
            : false;
    }

    public function onceUsingId($id): bool
    {
        $user = $this->provider->retrieveById($id);
        if ($user !== null) {
            $this->setUser($this->last_attempted);
            return true;
        }

        return false;
    }

    public function viaRemember(): bool
    {
        return false;
    }

    public function logout(): void
    {
        $this->user = null;
    }

    private function hasValidCredentials(?Authenticatable $user, array $credentials): bool
    {
        return $user !== null && $this->provider->validateCredentials($user, $credentials);
    }

    public function setRequest(Request $request): self
    {
        $this->request = $request;

        return $this;
    }
}
