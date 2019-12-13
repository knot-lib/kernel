<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Request;

use Psr\Http\Message\ServerRequestInterface;

interface ServerRequestConvertibleInterface
{
    /**
     * Convert to PSR Server Request
     *
     * @return ServerRequestInterface
     */
    public function convertToServerRequest() : ServerRequestInterface;
}