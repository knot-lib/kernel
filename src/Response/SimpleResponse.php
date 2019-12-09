<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Response;

final class SimpleResponse implements ResponseInterface
{
    /** @var StreamInterface */
    private $stream;

    /**
     * {@inheritDoc}
     */
    public function body(StreamInterface $stream = null) : StreamInterface
    {
        if ($stream){
            $this->stream = $stream;
        }
        if (!$this->stream){
            $this->stream = new Stream();
        }
        return $this->stream;
    }

}