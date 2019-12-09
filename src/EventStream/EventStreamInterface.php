<?php
namespace KnotLib\Kernel\EventStream;

interface EventStreamInterface
{
    /**
     * Get channel object
     *
     * @param string $channel_id
     *
     * @return EventChannelInterface
     */
    public function channel(string $channel_id) : EventChannelInterface;

    /**
     * Update auto flush flags in all channels
     *
     * @param bool $auto_flush
     *
     * @return EventStreamInterface
     */
    public function setAutoFlush(bool $auto_flush) : EventStreamInterface;

    /**
     * flush event in all channels
     *
     * @return EventStreamInterface
     */
    public function flush() : EventStreamInterface;
}