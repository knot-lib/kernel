<?php
namespace KnotLib\Kernel\Session;

class JsonFileSessionBucket implements SessionBucketInterface
{
    /** @var array */
    private $data;

    /**
     * JsonFileSessionBucket constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Returns all elements
     *
     * @return array
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * Returns element of session object
     *
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key) : bool
    {
        return isset($this->data[$key]);
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
        return $this->data[$key] ?? $default;
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
        $this->data[$key] = $value;
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
        unset($this->data[$key]);
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
        $this->data = [];
    }


    /**
     * Whether a offset exists
     *
     * @param mixed $offset
     * @return boolean true on success or false on failure.
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @param mixed $offset
     *
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return $this->data[$offset] ?? null;
    }

    /**
     * Offset to set
     *
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    /**
     * Offset to unset
     *
     * @param mixed $offset
     */
    public function offsetUnset($offset){
        unset($this->data[$offset]);
    }
}