<?php

declare(strict_types=1);

namespace DarthSoup\Whmcs\Auth;

use InvalidArgumentException;

class AuthFactory
{
    public function make(string $method): AuthInterface
    {
        return match ($method) {
            'password' => new Method\PasswordAuth(),
            'token' => new Method\TokenAuth(),
            default => throw new InvalidArgumentException("Unsupported authentication method [$method]."),
        };
    }
}
