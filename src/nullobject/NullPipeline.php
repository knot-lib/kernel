<?php
declare(strict_types=1);

namespace knotlib\kernel\nullobject;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;

use knotlib\kernel\pipeline\PipelineInterface;

final class NullPipeline implements PipelineInterface
{
    /**
     * Add middleware to pipeline
     *
     * @param MiddlewareInterface $middleware
     *
     * @return PipelineInterface
     */
    public function push(MiddlewareInterface $middleware) : PipelineInterface
    {
        return $this;
    }

    /**
     * Execure pipeline
     *
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function run(ServerRequestInterface $request) : ResponseInterface
    {
        return new NullResponse();
    }
}