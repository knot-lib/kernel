<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Request;

use Psr\Http\Server\RequestHandlerInterface;


interface PsrRequestHandlerConvertibleInterface
{
    /**
     * Convert to PSR Request Handler
     *
     * @return RequestHandlerInterface
     */
    public function convertToPsrRequestHandler() : RequestHandlerInterface;
}