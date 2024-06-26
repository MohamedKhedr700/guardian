<?php

declare(strict_types=1);

namespace Raid\Guardian\Authenticators\Contracts;

use Illuminate\Contracts\Auth\Authenticatable;
use Raid\Guardian\Channels\Contracts\ChannelInterface;
use Raid\Guardian\Tokens\Contracts\TokenInterface;

interface AuthenticatorInterface
{
    public static function new(): static;

    public static function getName(): string;

    public function attempt(array $credentials, ?string $channel = null, ?TokenInterface $token = null): ChannelInterface;

    public function login(Authenticatable $authenticatable, ?string $channel = null, ?TokenInterface $token = null): ChannelInterface;

    public function setAuthenticates(string $authenticates): static;

    public function getAuthenticates(): string;

    public function setChannels(array $channels): static;

    public function getChannels(): array;

    public function setDefaultChannel(string $channel): static;

    public function getDefaultChannel(): string;
}
