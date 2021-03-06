<?php
declare(strict_types=1);

namespace knotlib\kernel;

use knotlib\kernel\exceptionhandler\CallableExceptionHandler;
use knotlib\kernel\module\CallableModuleFactory;
use Throwable;

use knotlib\kernel\exceptionhandler\ExceptionHandlerInterface;
use knotlib\kernel\module\ModuleFactoryInterface;
use knotlib\kernel\filesystem\FileSystemInterface;
use knotlib\kernel\kernel\ApplicationInterface;

class Bootstrap
{
    /** @var FileSystemInterface */
    private $fs;

    /** @var ApplicationInterface */
    private $app;

    /** @var ExceptionHandlerInterface */
    private $ex_handler;

    /** @var ModuleFactoryInterface[] */
    private $module_factories;

    /** @var array */
    private $prepared_modules;

    /** @var array */
    private $unprepared_modules;

    /** @var array */
    private $prepared_packages;

    /** @var array */
    private $unprepared_packages;

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
     * Prepare module
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
     * Unrepare module
     *
     * @param string $module_class
     *
     * @return $this
     */
    public function withoutModule(string $module_class) : self
    {
        if (!$this->unprepared_modules || !in_array($module_class, $this->unprepared_modules)){
            $this->unprepared_modules[] = $module_class;
        }
        return $this;
    }

    /**
     * Prepare package
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
     * Unprepare package
     *
     * @param string $package_class
     *
     * @return $this
     */
    public function withoutPakcage(string $package_class) : self
    {
        if (!$this->unprepared_packages || !in_array($package_class, $this->unprepared_packages)){
            $this->unprepared_packages[] = $package_class;
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
            $this->module_factories[] = new CallableModuleFactory($module_factory);
        }
        else if ($module_factory instanceof ModuleFactoryInterface){
            $this->module_factories[] = $module_factory;
        }
        return $this;
    }

    /**
     * Start application
     *
     * @param string $app_class
     * @param callable|null $app_created_callback
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
            $this->app->configure();

            if ($this->prepared_packages){
                foreach($this->prepared_packages as $package){
                    $this->app->requirePackage($package);
                }
            }
            if ($this->unprepared_packages){
                foreach($this->unprepared_packages as $package){
                    $this->app->unrequirePackage($package);
                }
            }
            if ($this->prepared_modules){
                foreach($this->prepared_modules as $module){
                    $this->app->requireModule($module);
                }
            }
            if ($this->unprepared_modules){
                foreach($this->unprepared_modules as $module){
                    $this->app->unrequireModule($module);
                }
            }
            if ($this->module_factories){
                foreach($this->module_factories as $factory) {
                    $this->app->addModuleFactory($factory);
                }
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
     * @return void
     */
    private function handleExceptionInternal(Throwable $e) : void
    {
        // if error is handled, do nothing after the handler
        if ($this->app){
            $this->app->handleException($e);
        }

        if ($this->ex_handler){
            $this->ex_handler->handleException($e);
        }

    }
}