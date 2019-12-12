<?php
namespace KnotLib\Kernel\Pipeline;

use KnotLib\Kernel\Request\RequestInterface;
use KnotLib\Kernel\Request\RequestHandlerInterface;
use KnotLib\Kernel\Response\ResponseInterface;

interface MiddlewareInterface
{
    /**
     * Process middleware
     *
     * @param RequestInterface $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler);
}