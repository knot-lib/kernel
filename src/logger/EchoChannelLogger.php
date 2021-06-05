<?php
declare(strict_types=1);

namespace knotlib\kernel\logger;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

class EchoChannelLogger extends AbstractLogger implements LoggerChannelInterface
{
    private $enabled;

    /**
     * EchoLogger constructor.
     *
     * @param bool $enabled
     */
    public function __construct(bool $enabled = true)
    {
        $this->enabled = $enabled;
    }

    /**
     * Enable log channel
     *
     * @param bool $enabled
     *
     * @return LoggerChannelInterface
     */
    public function enable(bool $enabled) : LoggerChannelInterface
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        if (!$this->enabled){
            return;
        }
        $levels = [
            LogLevel::DEBUG => 'D',
            LogLevel::INFO => 'I',
            LogLevel::NOTICE => 'N',
            LogLevel::WARNING => 'W',
            LogLevel::ERROR => 'E',
            LogLevel::CRITICAL => 'C',
            LogLevel::ALERT => 'A',
            LogLevel::EMERGENCY => 'E',
        ];
        echo '[' . $levels[$level] . ']' . $message . ' ' . json_encode($context) . PHP_EOL;
    }
}