<?php
namespace KnotLib\Kernel\NullObject;

use KnotLib\Kernel\Di\DiContainerInterface;

final class NullDi implements DiContainerInterface
{
    /**
     * {@inheritDoc}
     */
    public function get($id)
    {
        return null;
    }
    
    /**
     * {@inheritDoc}
     */
    public function has($id)
    {
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet($id)
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($id, $value)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function offsetExists($id)
    {
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($id)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function extend(string $id, callable $extend_callback)
    {

    }
}