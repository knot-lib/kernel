<?php
namespace KnotLib\Kernel\Response;

use RuntimeException;

interface StreamInterface
{
    /**
     * Write data to the stream.
     *
     * @param string $string
     * @return int
     * @throws RuntimeException on failure.
     */
    public function write(string $string) : int;

    public function __toString();
}