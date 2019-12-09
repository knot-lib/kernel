<?php
namespace KnotLib\Kernel\Cache;

interface CacheInterface
{
    /**
     * Returns cache data associated with specified key.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key);

    /**
     * save cache data associated with specified key.
     *
     * @param string $key
     * @param mixed $data
     */
    public function set(string $key, $data);

    /**
     * Removes a cache item
     *
     * @param string $key
     */
    public function delete( $key );
}