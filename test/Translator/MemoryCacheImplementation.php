<?php

declare(strict_types=1);

namespace LaminasTest\I18n\Translator;

use DateInterval;
use Psr\SimpleCache\CacheInterface;

class MemoryCacheImplementation implements CacheInterface
{
    /** @var array<string, mixed> */
    private array $cache = [];
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->cache[$key] ?? $default;
    }

    public function set(string $key, mixed $value, null|int|DateInterval $ttl = null): bool
    {
        $this->cache[$key] = $value;
        return true;
    }

    public function delete(string $key): bool
    {
        if (! $this->has($key)) {
            return false;
        }
        unset($this->cache[$key]);
        return true;
    }

    public function clear(): bool
    {
        $this->cache = [];
        return true;
    }

    public function getMultiple(iterable $keys, mixed $default = null): iterable
    {
        $results = [];
        foreach ($keys as $key) {
            $results[$key] = $this->get($key, $default);
        }
        return $results;
    }

    public function setMultiple(iterable $values, null|int|DateInterval $ttl = null): bool
    {
        foreach ($values as $key => $value) {
            $this->set($key, $value);
        }
        return true;
    }

    public function deleteMultiple(iterable $keys): bool
    {
        foreach ($keys as $key) {
            $this->delete($key);
        }
        return true;
    }

    public function has(string $key): bool
    {
        return isset($this->cache[$key]);
    }
}
