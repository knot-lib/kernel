<?php
namespace KnotLib\Kernel\Response;

interface ResponseInterface
{
    /**
     * Get/set body stream
     *
     * @param StreamInterface $stream
     *
     * @return StreamInterface
     */
    public function body(StreamInterface $stream = null) : StreamInterface;
}