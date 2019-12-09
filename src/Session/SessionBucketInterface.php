<?php
namespace KnotLib\Kernel\Session;

use ArrayAccess;

interface SessionBucketInterface extends ArrayAccess
{
    /**
     * Returns element of session object
     *
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key) : bool;
    
    /**
     * Returns element of session object
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null);
    
    /**
     * Set element of session object
     *
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    public function set(string $key, $value);
    
    /**
     * Clear element of session object
     *
     * @param string $key
     *
     * @return void
     */
    public function unset(string $key);
    
    /**
     *
     * Clear all data from the segment.
     *
     * @return void
     *
     */
    public function clear();
}