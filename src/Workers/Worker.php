<?php

declare(strict_types=1);

namespace Raid\Core\Guardian\Workers;

use Illuminate\Contracts\Auth\Authenticatable;
use Raid\Core\Guardian\Authenticates\Contracts\Authenticates;
use Raid\Core\Guardian\Workers\Contracts\WorkerInterface;

abstract class Worker implements WorkerInterface
{
    public const ATTRIBUTE = '';

    public const QUERY_ATTRIBUTE = null;

    public static function getAttribute(): string
    {
        return static::ATTRIBUTE;
    }

    protected static function getQueryAttribute(): ?string
    {
        return static::QUERY_ATTRIBUTE;
    }

    protected function getWorkerAttribute(): string
    {
        return static::getQueryAttribute() ?? static::getAttribute();
    }

    protected function getWorkerValue(array $credentials): mixed
    {
        return $credentials[static::getAttribute()];
    }

    public function find(Authenticates $authenticates, array $credentials): ?Authenticatable
    {
        return $authenticates->findForAuthentication(
            $this->getWorkerAttribute(),
            $this->getWorkerValue($credentials),
        );
    }
}
