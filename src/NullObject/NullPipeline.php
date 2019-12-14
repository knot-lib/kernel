<?php
declare(strict_types=1);

namespace KnotLib\Kernel\NullObject;

use KnotLib\Kernel\Pipeline\PipelineInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;

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
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function run(RequestInterface $request) : ResponseInterface
    {
        return null;
    }
}