<?php
declare(strict_types=1);

namespace KnotLib\Kernel;

use Throwable;

use KnotLib\Kernel\FileSystem\FileSystemInterface;
use KnotLib\Kernel\Kernel\ApplicationInterface;
use KnotLib\Kernel\Kernel\ApplicationType;
use KnotLib\ExceptionHandler\DebugtraceRenderer\ConsoleDebugtraceRenderer;
use KnotLib\ExceptionHandler\DebugtraceRenderer\HtmlDebugtraceRenderer;
use KnotLib\ExceptionHandler\Handler\PrintExceptionHandler;

class Bootstrap
{
    /** @var FileSystemInterface */
    private $fs;

    /** @var ApplicationInterface */
    private $app;

    /** @var callable */
    private $ex_handler;

    /**
     * Mount file system
     *
     * @param FileSystemInterface $fs
     *
     * @return self
     */
    public function mount(FileSystemInterface $fs) : self
    {
        $this->fs = $fs;
        return $this;
    }

    /**
     * Start application
     *
     * @param string $app_class
     *
     * @return self
     */
    public function boot(string $app_class) : self
    {
        $this->app = $this->fs ? new $app_class($this->fs) : new $app_class;

        try{
            $this->app->run();
        }
        catch(Throwable $e){
            $this->handleExceptionInternal($e);
        }
        return $this;
    }

    /**
     * Set global exception handler
     *
     * @param callable $ex_handler
     *
     * @return self
     */
    public function handleException(callable $ex_handler) : self
    {
        $this->ex_handler = $ex_handler;
        return $this;
    }

    /**
     * handle an exception
     *
     * @param Throwable $e     exception to handle
     *
     * @return self
     */
    private function handleExceptionInternal(Throwable $e) : self
    {
        // if error is handled, do nothing after the handler
        if ($this->app){
            if ($this->app->handleException($e)){
                return $this;
            }
        }

        if ($this->ex_handler){
            if (($this->ex_handler)($e)){
                return $this;
            }
        }

        // show errors by debugtrace renderer
        $renderer = null;

        if (!$this->app || $this->app->type()->is(ApplicationType::CLI)){
            $renderer = new ConsoleDebugtraceRenderer();
        }
        else if ($this->app->type()->is(ApplicationType::WEB_APP)){
            $renderer = new HtmlDebugtraceRenderer();
        }

        (new PrintExceptionHandler($renderer))->handleException($e);

        return $this;
    }
}