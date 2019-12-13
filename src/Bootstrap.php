<?php
declare(strict_types=1);

namespace KnotLib\Kernel;

use Throwable;

use KnotLib\Kernel\FileSystem\FileSystemInterface;
use KnotLib\Kernel\Kernel\ApplicationInterface;

class Bootstrap
{
    /** @var FileSystemInterface */
    private $fs;

    /** @var ApplicationInterface */
    private $app;

    /** @var callable */
    private $ex_handler;

    /** @var array */
    private $prepared_modules = [];

    /** @var array */
    private $prepared_packages = [];

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
     * Prepare to install module
     *
     * @param string $module_class
     *
     * @return $this
     */
    public function prepareModule(string $module_class) : self
    {
        if (!in_array($module_class, $this->prepared_modules)){
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
    public function preparePakcage(string $package_class) : self
    {
        if (!in_array($package_class, $this->prepared_packages)){
            $this->prepared_packages[] = $package_class;
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
            foreach($this->prepared_packages as $package){
                $this->app->requirePackage($package);
            }
            foreach($this->prepared_modules as $module){
                $this->app->requireModule($module);
            }
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
            $this->app->handleException($e);
        }

        if ($this->ex_handler){
            ($this->ex_handler)($e);
        }

        return $this;
    }
}