<?php
declare(strict_types=1);

namespace KnotLib\Kernel;

use KnotLib\Kernel\ExceptionHandler\CallableExceptionHandler;
use KnotLib\Kernel\Module\CallableModuleFactory;
use Throwable;

use KnotLib\Kernel\ExceptionHandler\ExceptionHandlerInterface;
use KnotLib\Kernel\Module\ModuleFactoryInterface;
use KnotLib\Kernel\FileSystem\FileSystemInterface;
use KnotLib\Kernel\Kernel\ApplicationInterface;

class Knot
{
    /** @var FileSystemInterface */
    private $fs;

    /** @var ApplicationInterface */
    private $app;

    /** @var ExceptionHandlerInterface */
    private $ex_handler;

    /** @var ModuleFactoryInterface */
    private $module_factory;

    /** @var array */
    private $prepared_modules;

    /** @var array */
    private $prepared_packages;

    /**
     * Mount file system
     *
     * @param FileSystemInterface $fs
     *
     * @return self
     */
    public function withFileSystem(FileSystemInterface $fs) : self
    {
        $this->fs = $fs;
        return $this;
    }

    /**
     * Prepare to install module
     *
     * @param string $module_class
     *
     * @return $this
     */
    public function withModule(string $module_class) : self
    {
        if (!$this->prepared_modules || !in_array($module_class, $this->prepared_modules)){
            $this->prepared_modules[] = $module_class;
        }
        return $this;
    }

    /**
     * Prepare to install module
     *
     * @param string $package_class
     *
     * @return $this
     */
    public function withPakcage(string $package_class) : self
    {
        if (!$this->prepared_packages || !in_array($package_class, $this->prepared_packages)){
            $this->prepared_packages[] = $package_class;
        }
        return $this;
    }

    /**
     * Set global exception handler
     *
     * @param callable|ExceptionHandlerInterface $ex_handler
     *
     * @return self
     */
    public function withExceptionHandler($ex_handler) : self
    {
        if (is_callable($ex_handler)){
            $this->ex_handler = new CallableExceptionHandler($ex_handler);
        }
        else if ($ex_handler instanceof ExceptionHandlerInterface){
            $this->ex_handler = $ex_handler;
        }
        return $this;
    }

    /**
     * Set module factory
     *
     * @param callable|ModuleFactoryInterface $module_factory
     *
     * @return $this
     */
    public function withModuleFactory($module_factory) : self
    {
        if (is_callable($module_factory)){
            $this->module_factory = new CallableModuleFactory($module_factory);
        }
        else if ($module_factory instanceof ModuleFactoryInterface){
            $this->module_factory = $module_factory;
        }
        return $this;
    }

    /**
     * Start application
     *
     * @param string $app_class
     * @param callable $app_created_callback
     *
     * @return self
     */
    public function boot(string $app_class, callable $app_created_callback = null) : self
    {
        $this->app = $this->fs ? new $app_class($this->fs) : new $app_class;

        if ($app_created_callback){
            ($app_created_callback)($this->app);
        }

        try{
            if ($this->prepared_packages){
                foreach($this->prepared_packages as $package){
                    $this->app->requirePackage($package);
                }
            }
            if ($this->prepared_modules){
                foreach($this->prepared_modules as $module){
                    $this->app->requireModule($module);
                }
            }
            if ($this->module_factory){
                $this->app->setModuleFactory($this->module_factory);
            }
            $this->app->run();
        }
        catch(Throwable $e){
            $this->handleExceptionInternal($e);
        }
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
            $this->app->handleException($e);
        }

        if ($this->ex_handler){
            $this->ex_handler->handleException($e);
        }

        return $this;
    }
}