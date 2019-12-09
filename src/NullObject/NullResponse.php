<?php
namespace KnotLib\Kernel\NullObject;

use KnotLib\Kernel\Response\ResponseInterface;
use KnotLib\Kernel\Response\StreamInterface;

final class NullResponse implements ResponseInterface
{
    /**
     * Get/set body stream
     *
     * @param StreamInterface $stream
     *
     * @return StreamInterface
     */
    public function body(StreamInterface $stream = null) : StreamInterface
    {
        return null;
    }
}