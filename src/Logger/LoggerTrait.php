<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Logger;

use Stk2k\Util\Util;

trait LoggerTrait
{
    /**
     * Get logger
     *
     * @return LoggerInterface
     */
    public abstract function getLogger() : LoggerInterface;

    /**
     * Get channel id
     *
     * @return string
     */
    public abstract function getChannelId() : string;

    /**
     * write alert log
     *
     * @param string $message
     * @param array $context
     */
    public function emergency(string $message, array $context = null)
    {
        if (!$context){
            list($file, $line) = Util::caller(1);
            $context = [
                'file' => $file,
                'line' => $line,
            ];
        }
        $this->getLogger()->channel($this->getChannelId())->emergency($message, $context);
    }

    /**
     * write alert log
     *
     * @param string $message
     * @param array $context
     */
    public function alert(string $message, array $context = null)
    {
        if (!$context){
            list($file, $line) = Util::caller(1);
            $context = [
                'file' => $file,
                'line' => $line,
            ];
        }
        $this->getLogger()->channel($this->getChannelId())->alert($message, $context);
    }

    /**
     * write critical log
     *
     * @param string $message
     * @param array $context
     */
    public function critical(string $message, array $context = null)
    {
        if (!$context){
            list($file, $line) = Util::caller(1);
            $context = [
                'file' => $file,
                'line' => $line,
            ];
        }
        $this->getLogger()->channel($this->getChannelId())->critical($message, $context);
    }

    /**
     * write error log
     *
     * @param string $message
     * @param array $context
     */
    public function error(string $message, array $context = null)
    {
        if (!$context){
            list($file, $line) = Util::caller(1);
            $context = [
                'file' => $file,
                'line' => $line,
            ];
        }
        $this->getLogger()->channel($this->getChannelId())->error($message, $context);
    }

    /**
     * write warning log
     *
     * @param string $message
     * @param array $context
     */
    public function warning(string $message, array $context = null)
    {
        if (!$context){
            list($file, $line) = Util::caller(1);
            $context = [
                'file' => $file,
                'line' => $line,
            ];
        }
        $this->getLogger()->channel($this->getChannelId())->warning($message, $context);
    }

    /**
     * write notice log
     *
     * @param string $message
     * @param array $context
     */
    public function notice(string $message, array $context = null)
    {
        if (!$context){
            list($file, $line) = Util::caller(1);
            $context = [
                'file' => $file,
                'line' => $line,
            ];
        }
        $this->getLogger()->channel($this->getChannelId())->notice($message, $context);
    }

    /**
     * write info log
     *
     * @param string $message
     * @param array $context
     */
    public function info(string $message, array $context = null)
    {
        if (!$context){
            list($file, $line) = Util::caller(1);
            $context = [
                'file' => $file,
                'line' => $line,
            ];
        }
        $this->getLogger()->channel($this->getChannelId())->info($message, $context);
    }

    /**
     * write debug log
     *
     * @param string $message
     * @param array $context
     */
    public function debug(string $message, array $context = null)
    {
        if (!$context){
            list($file, $line) = Util::caller(1);
            $context = [
                'file' => $file,
                'line' => $line,
            ];
        }
        $this->getLogger()->channel($this->getChannelId())->debug($message, $context);
    }

}