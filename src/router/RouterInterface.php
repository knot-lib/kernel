<?php
declare(strict_types=1);

namespace knotlib\kernel\router;

use knotlib\kernel\exception\RoutingException;

interface RouterInterface
{
    /**
     * Bind rule
     *
     * @param string $routing_rule
     * @param string $filter
     * @param string $route_name
     * @param callable|null $callback
     *
     * @return RouterInterface
     *
     * @throws RoutingException
     */
    public function bind(string $routing_rule, string $filter, string $route_name, callable $callback = null) : RouterInterface;

    /**
     * Set not found callback
     *
     * @param callable|null $not_found_callback
     *
     * @return RouterInterface
     */
    public function notFound(callable $not_found_callback = null) : RouterInterface;

    /**
     * Route path
     *
     * filter: '*' means all filter passes
     *
     * callback: will be called after the event was dispathed.
     *
     * callback prototype:     *
     *     function (callback)(
     *         array $vars,      // parsed parameters included in path(i.e. /books/:book_id => /books/15 will returns ['book_id' => 15])
     *         string $event     // found event name which is specified by bind method
     *     ) : void;
     *
     * @param string $route_url
     * @param string $filter
     * @param callable|null $callback
     */
    public function route(string $route_url, string $filter, callable $callback = null);
}