<?php
declare(strict_types=1);

namespace knotlib\kernel\pipeline;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;

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
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function run(ServerRequestInterface $request) : ResponseInterface;
}