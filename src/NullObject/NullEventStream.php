<?php
declare(strict_types=1);

namespace KnotLib\Kernel\NullObject;

use KnotLib\Kernel\EventStream\EventStreamInterface;
use KnotLib\Kernel\EventStream\EventChannelInterface;

final class NullEventStream implements EventStreamInterface
{
    /**
     * Get channel object
     *
     * @param string $channel_id
     *
     * @return EventChannelInterface
     */
    public function channel(string $channel_id) : EventChannelInterface
    {
        return new NullEventChannel;
    }

    /**
     * Update auto flush flags in all channels
     *
     * @param bool $auto_flush
     *
     * @return EventStreamInterface
     */
    public function setAutoFlush(bool $auto_flush) : EventStreamInterface
    {
        return $this;
    }

    /**
     * flush event in all channels
     *
     * @return EventStreamInterface
     */
    public function flush() : EventStreamInterface
    {
        return $this;
    }
}