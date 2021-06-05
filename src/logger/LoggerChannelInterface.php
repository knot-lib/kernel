<?php
declare(strict_types=1);

namespace knotlib\kernel\logger;

use Psr\Log\LoggerInterface as PsrLoggerInterface;

interface LoggerChannelInterface extends PsrLoggerInterface
{
    /**
     * Enable log channel
     *
     * @param bool $enabled
     *
     * @return LoggerChannelInterface
     */
    public function enable(bool $enabled) : LoggerChannelInterface;
}