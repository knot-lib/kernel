<?php
namespace KnotLib\Kernel\NullObject;

use KnotLib\Kernel\Session\SessionBucketInterface;

final class NullSessionBucket implements SessionBucketInterface
{
    /**
     * Returns element of session object
     *
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key) : bool
    {
        return false;
    }

    /**
     * Returns element of session object
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return null;
    }

    /**
     * Set element of session object
     *
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    public function set(string $key, $value)
    {
        // do nothing
    }

    /**
     * Clear element of session object
     *
     * @param string $key
     *
     * @return void
     */
    public function unset(string $key)
    {
        // do nothing
    }

    /**
     *
     * Clear all data from the segment.
     *
     * @return void
     *
     */
    public function clear()
    {
        // do nothing
    }

    /**
     * @param $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return false;
    }

    /**
     * @param $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return null;
    }

    /**
     * @param $offset
     * @param $value
     */
    public function offsetSet($offset, $value)
    {
        // do nothing
    }

    /**
     * @param $offset
     */
    public function offsetUnset($offset)
    {
        // do nothing
    }
}