<?php
namespace KnotLib\Kernel\NullObject;

use KnotLib\Kernel\Router\RouterInterface;

final class NullRouter implements RouterInterface
{
    /**
     * {@inheritDoc}
     */
    public function bind(string $routing_rule, string $filter, string $route_name, callable $callback = null) : RouterInterface
    {
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function notFound(callable $not_found_callback = null) : RouterInterface
    {
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function route(string $route_url, string $filter, callable $callback = null)
    {
    }
}