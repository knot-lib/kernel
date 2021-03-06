<?php
declare(strict_types=1);

namespace knotlib\kernel\nullobject;

use knotlib\kernel\router\RouterInterface;

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