<?php
namespace KnotLib\Kernel\Response;

use RuntimeException;

class Stream implements StreamInterface
{
    private $buffer;

    /**
     * Write data to the stream.
     *
     * @param string $string
     * @return int
     * @throws RuntimeException on failure.
     */
    public function write(string $string) : int
    {
        $this->buffer .= $string;

        return strlen($string);
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->buffer;
    }
}