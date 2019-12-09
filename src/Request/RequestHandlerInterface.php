<?php
namespace KnotLib\Kernel\Request;

use KnotLib\Kernel\Response\ResponseInterface;

interface RequestHandlerInterface
{
    /**
     * Handle request
     *
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request) : ResponseInterface;
}