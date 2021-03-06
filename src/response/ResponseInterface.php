<?php
declare(strict_types=1);

namespace knotlib\kernel\response;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

interface ResponseInterface extends PsrResponseInterface
{
    /**
     * Append text to response body
     *
     * @param string $text
     *
     * @return mixed
     */
    public function write(string $text);
}