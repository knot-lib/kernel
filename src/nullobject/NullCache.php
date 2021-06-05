<?php
declare(strict_types=1);

namespace knotlib\kernel\nullobject;

use knotlib\kernel\cache\CacheInterface;

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