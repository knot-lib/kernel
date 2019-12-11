<?php
declare(strict_types=1);

namespace KnotLib\Kernel\NullObject;

use KnotLib\Kernel\Cache\CacheInterface;

final class NullCache implements CacheInterface
{
    /**
     * Returns cache data associated with specified key.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key)
    {
        return null;
    }

    /**
     * save cache data associated with specified key.
     *
     * @param string $key
     * @param mixed $data
     */
    public function set(string $key, $data)
    {
    }

    /**
     * Removes a cache item
     *
     * @param string $key
     */
    public function delete( $key )
    {
    }
}