<?php
namespace KnotLib\Kernel\Pipeline;

use KnotLib\Kernel\Request\RequestInterface;
use KnotLib\Kernel\Response\ResponseInterface;

interface PipelineInterface
{
    /**
     * Add middleware to pipeline
     *
     * @param MiddlewareInterface $middleware
     *
     * @return PipelineInterface
     */
    public function push(MiddlewareInterface $middleware) : PipelineInterface;

    /**
     * Execure pipeline
     *
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function run(RequestInterface $request) : ResponseInterface;
}