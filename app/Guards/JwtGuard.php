<?php

namespace App\Guards;

use App\Services\JwtService;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Traits\Macroable;

class JwtGuard implements Guard
{
    use GuardHelpers;
    use Macroable;

    private Request $request;

    private JwtService $jwtService;

    public function __construct()
    {
        $this->jwtService = app(JwtService::class);
        $this->request = request();

        $this->setProvider($this->createProvider());
    }

    public function createProvider(): UserProvider
    {
        $providerName = config('auth.guards.api.provider');

        assert(is_string($providerName));

        $provider = Auth::createUserProvider($providerName);

        assert($provider instanceof UserProvider);

        return $provider;
    }

    public function user(): ?Authenticatable
    {
        if ($this->user) {
            return $this->user;
        }

        $token = $this->getTokenForRequest();

        if (! $token) {
            return null;
        }

        try {
            $payload = $this->jwtService->decode($token);

            $this->user = $this->provider->retrieveById($payload->user_id);
        } catch (\Exception $e) {
            return null;
        }

        return $this->user;
    }

    /**
     * @param  array<string, string>  $credentials
     */
    public function validate(array $credentials = []): bool
    {
        return true;
    }

    protected function getTokenForRequest(): ?string
    {
        $token = $this->request->bearerToken();

        if (empty($token)) {
            $token = $this->request->query('token');

            if (is_array($token)) {
                $token = (string) array_shift($token);
            }
        }

        return $token;
    }

    public function logout(): void {}
}
