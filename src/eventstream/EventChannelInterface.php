<?php
declare(strict_types=1);

namespace knotlib\kernel\eventstream;

use knotlib\kernel\exception\EventStreamException;

interface EventChannelInterface
{
    /**
     * Subscribe to event channel
     *
     * @param string $event
     * @param callable $callback
     *
     * @return EventChannelInterface
     */
    public function listen(string $event, callable $callback) : EventChannelInterface;

    /**
     * Push an event to channel
     *
     * @param string $event
     * @param mixed $event_args
     *
     * @return EventChannelInterface
     *
     * @throws EventStreamException
     */
    public function push(string $event, $event_args = null) : EventChannelInterface;

    /**
     * Update auto flush
     *
     * @param bool $auto_flush
     *
     * @return EventChannelInterface
     */
    public function setAutoFlush(bool $auto_flush) : EventChannelInterface;

    /**
     * flush event
     *
     * @return EventChannelInterface
     */
    public function flush() : EventChannelInterface;
}