<?php
declare(strict_types=1);

namespace knotlib\kernel\logger;

use Psr\Log\LogLevel;

abstract class AbstractLogger implements LoggerInterface
{
    /**
     * {@inheritDoc}
     */
    public function emergency($message, array $context = array())
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function alert($message, array $context = array())
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function critical($message, array $context = array())
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function error($message, array $context = array())
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function warning($message, array $context = array())
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function notice($message, array $context = array())
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function info($message, array $context = array())
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function debug($message, array $context = array())
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    abstract public function log($level, $message, array $context = array());

    /**
     * {@inheritDoc}
     */
    abstract public function channel(string $channel_id) : LoggerChannelInterface;
}