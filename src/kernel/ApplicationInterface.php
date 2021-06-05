<?php
declare(strict_types=1);

namespace knotlib\kernel\kernel;

use Throwable;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use knotlib\kernel\exception\ApplicationExecutionException;
use knotlib\kernel\exceptionhandler\ExceptionHandlerInterface;
use knotlib\kernel\filesystem\FileSystemInterface;
use knotlib\kernel\logger\LoggerInterface;
use knotlib\kernel\module\ModuleInterface;
use knotlib\kernel\module\ModuleFactoryInterface;
use knotlib\kernel\router\RouterInterface;
use knotlib\kernel\di\DiContainerInterface;
use knotlib\kernel\pipeline\PipelineInterface;
use knotlib\kernel\cache\CacheInterface;
use knotlib\kernel\session\SessionInterface;
use knotlib\kernel\eventstream\EventStreamInterface;
use knotlib\kernel\responder\ResponderInterface;
use knotlib\kernel\templateengine\TemplateEngineInterface;

interface ApplicationInterface
{
    /**
     * ApplicationInterface constructor.
     *
     * @param FileSystemInterface $filesystem
     */
    public function __construct(FileSystemInterface $filesystem = null);

    /**
     * Returns application type
     *
     * @return ApplicationType
     */
    public static function type() : ApplicationType;

    /**
     * Get file system
     *
     * @return FileSystemInterface
     */
    public function filesystem() : FileSystemInterface;

    /**
     * Set/get logger
     *
     * @param LoggerInterface $logger
     *
     * @return LoggerInterface
     */
    public function logger(LoggerInterface $logger = null) : LoggerInterface;

    /**
     * Set/get router
     *
     * @param RouterInterface $router
     *
     * @return RouterInterface
     */
    public function router(RouterInterface $router = null) : RouterInterface;

    /**
     * Set/get di container
     *
     * @param DiContainerInterface $di
     *
     * @return DiContainerInterface
     */
    public function di(DiContainerInterface $di = null) : DiContainerInterface;

    /**
     * Set/get request
     *
     * @param ServerRequestInterface $request
     *
     * @return ServerRequestInterface
     */
    public function request(ServerRequestInterface $request = null) : ServerRequestInterface;

    /**
     * Set/get response
     *
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function response(ResponseInterface $response = null) : ResponseInterface;

    /**
     * Set/get pipeline
     *
     * @param PipelineInterface $pipeline
     *
     * @return PipelineInterface
     */
    public function pipeline(PipelineInterface $pipeline = null) : PipelineInterface;

    /**
     * Set/get cache
     *
     * @param CacheInterface $cache
     *
     * @return CacheInterface
     */
    public function cache(CacheInterface $cache = null) : CacheInterface;
    
    /**
     * Set/get session
     *
     * @param SessionInterface $session
     *
     * @return SessionInterface
     */
    public function session(SessionInterface $session = null) : SessionInterface;

    /**
     * Set/get event stream
     *
     * @param EventStreamInterface $eventstream
     *
     * @return EventStreamInterface
     */
    public function eventstream(EventStreamInterface $eventstream = null) : EventStreamInterface;

    /**
     * Set/get responder
     *
     * @param ResponderInterface $responder
     *
     * @return ResponderInterface
     */
    public function responder(ResponderInterface $responder = null) : ResponderInterface;

    /**
     * Set/get template engine
     *
     * @param TemplateEngineInterface $engine
     *
     * @return TemplateEngineInterface
     */
    public function templateEngine(TemplateEngineInterface $engine = null) : TemplateEngineInterface;

    /**
     * Require a module
     *
     * @param string $module_class
     *
     * @return ApplicationInterface
     */
    public function requireModule(string $module_class) : self;

    /**
     * Unrequire a module
     *
     * @param string $module_class
     *
     * @return ApplicationInterface
     */
    public function unrequireModule(string $module_class) : self;

    /**
     * Require a package
     *
     * @param string $package_class
     *
     * @return ApplicationInterface
     */
    public function requirePackage(string $package_class) : self;

    /**
     * Unrequire a package
     *
     * @param string $package_class
     *
     * @return ApplicationInterface
     */
    public function unrequirePackage(string $package_class) : self;

    /**
     * Get list of required modules
     *
     * @return string[]
     */
    public function getRequiredModules() : array;

    /**
     * Get list of installed modules
     *
     * @return ModuleInterface[]
     */
    public function getInstalledModules() : array;

    /**
     * Add installed module
     *
     * @param string $module
     */
    public function addInstalledModule(string $module);

    /**
     * Get resolved modules
     *
     * @return string[]
     */
    public function getResolvedModules() : array;

    /**
     * Set resolved modules
     *
     * @param array $modules
     *
     * @return string[]
     */
    public function setResolvedModules(array $modules);

    /**
     * Add module factory
     *
     * @param ModuleFactoryInterface $module_factory
     *
     * @return ApplicationInterface
     */
    public function addModuleFactory(ModuleFactoryInterface $module_factory) : self;

    /**
     * Configure application
     *
     * @return ApplicationInterface
     */
    public function configure() : self;

    /**
     * Install required modules
     *
     * @return ApplicationInterface
     */
    public function install() : self;

    /**
     * Install a module
     *
     * @param string $module_class
     *
     * @return ApplicationInterface
     *
     * @throws
     */
    public function installModule(string $module_class) : self;

    /**
     * Execute application
     *
     * @return ApplicationInterface
     *
     * @throws ApplicationExecutionException
     */
    public function run() : self;

    /**
     * Register exception handler
     *
     * @param ExceptionHandlerInterface $handler
     *
     * @return ApplicationInterface
     */
    public function addExceptionHandler(ExceptionHandlerInterface $handler) : self;

    /**
     * Handle exception
     *
     * @param Throwable $e
     */
    public function handleException(Throwable $e);
}