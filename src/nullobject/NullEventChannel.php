<?php
declare(strict_types=1);

namespace knotlib\kernel\nullobject;

use knotlib\kernel\eventstream\EventChannelInterface;

final class NullEventChannel implements EventChannelInterface
{
    /**
     * Subscribe to event channel
     *
     * @param string $event
     * @param callable $callback
     *
     * @return EventChannelInterface
     */
    public function listen(string $event, callable $callback) : EventChannelInterface
    {
        return $this;
    }

    /**
     * Push an event to channel
     *
     * @param string $event
     * @param null $event_args
     *
     * @return EventChannelInterface
     */
    public function push(string $event, $event_args = null) : EventChannelInterface
    {
        return $this;
    }

    /**
     * Update auto flush
     *
     * @param bool $auto_flush
     *
     * @return EventChannelInterface
     */
    public function setAutoFlush(bool $auto_flush) : EventChannelInterface
    {
        return $this;
    }

    /**
     * flush event
     *
     * @return EventChannelInterface
     */
    public function flush() : EventChannelInterface
    {
        return $this;
    }
}