<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Kernel;

use Throwable;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

use KnotLib\Kernel\Module\ModuleFactoryInterface;
use KnotLib\Kernel\Exception\ApplicationExecutionException;
use KnotLib\Kernel\ExceptionHandler\ExceptionHandlerInterface;
use KnotLib\Kernel\FileSystem\FileSystemInterface;
use KnotLib\Kernel\Logger\LoggerInterface;
use KnotLib\Kernel\Module\ModuleInterface;
use KnotLib\Kernel\Router\RouterInterface;
use KnotLib\Kernel\Di\DiContainerInterface;
use KnotLib\Kernel\Pipeline\PipelineInterface;
use KnotLib\Kernel\Cache\CacheInterface;
use KnotLib\Kernel\Session\SessionInterface;
use KnotLib\Kernel\EventStream\EventStreamInterface;
use KnotLib\Kernel\Responder\ResponderInterface;
use KnotLib\Kernel\TemplateEngine\TemplateEngineInterface;

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
     * @param RequestInterface $request
     *
     * @return RequestInterface
     */
    public function request(RequestInterface $request = null) : RequestInterface;

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
     * Require a package
     *
     * @param string $package_class
     *
     * @return ApplicationInterface
     */
    public function requirePackage(string $package_class) : self;

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
     * Get module factory
     *
     * @return ModuleFactoryInterface|null
     */
    public function getModuleFactory();

    /**
     * Set module factory
     *
     * @param ModuleFactoryInterface $module_factory
     *
     * @return ApplicationInterface
     */
    public function setModuleFactory(ModuleFactoryInterface $module_factory) : self;

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
     * Install modules
     *
     * @param array $modules
     *
     * @return ApplicationInterface
     *
     * @throws
     */
    public function installModules(array $modules) : self;

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