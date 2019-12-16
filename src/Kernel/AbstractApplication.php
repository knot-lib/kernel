<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Kernel;

use Throwable;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use KnotLib\Kernel\Cache\CacheInterface;
use KnotLib\Kernel\Di\DiContainerInterface;
use KnotLib\Kernel\EventStream\EventStreamInterface;
use KnotLib\Kernel\Exception\ComponentNotInstalledException;
use KnotLib\Kernel\Exception\PackageRequireException;
use KnotLib\Kernel\ExceptionHandler\ExceptionHandlerInterface;
use KnotLib\Kernel\FileSystem\FileSystemInterface;
use KnotLib\Kernel\Logger\LoggerInterface;
use KnotLib\Kernel\Module\Components;
use KnotLib\Kernel\Module\ModuleInterface;
use KnotLib\Kernel\Module\PackageInterface;
use KnotLib\Kernel\Module\ModuleFactoryInterface;
use KnotLib\Kernel\NullObject\NullCache;
use KnotLib\Kernel\NullObject\NullDi;
use KnotLib\Kernel\NullObject\NullEventStream;
use KnotLib\Kernel\NullObject\NullFileSystem;
use KnotLib\Kernel\NullObject\NullLogger;
use KnotLib\Kernel\NullObject\NullPipeline;
use KnotLib\Kernel\NullObject\NullRequest;
use KnotLib\Kernel\NullObject\NullResponder;
use KnotLib\Kernel\NullObject\NullResponse;
use KnotLib\Kernel\NullObject\NullRouter;
use KnotLib\Kernel\NullObject\NullSession;
use KnotLib\Kernel\NullObject\NullTemplateEngine;
use KnotLib\Kernel\Pipeline\PipelineInterface;
use KnotLib\Kernel\Responder\ResponderInterface;
use KnotLib\Kernel\Router\RouterInterface;
use KnotLib\Kernel\Session\SessionInterface;
use KnotLib\Kernel\TemplateEngine\TemplateEngineInterface;

abstract class AbstractApplication implements ApplicationInterface
{
    /** @var FileSystemInterface */
    private $filesystem;

    /** @var string[] */
    private $required_modules = [];

    /** @var string[] */
    private $resolved_modules = [];

    /** @var ModuleFactoryInterface[] */
    private $module_factories = [];

    /** @var ModuleInterface[] */
    private $installed_modules = [];

    /** @var ExceptionHandlerInterface[] */
    private $ex_handlers = [];

    /** @var LoggerInterface */
    private $logger;

    /** @var RouterInterface */
    private $router;

    /** @var DiContainerInterface */
    private $di;

    /** @var ServerRequestInterface */
    private $request;

    /** @var ResponseInterface */
    private $response;

    /** @var PipelineInterface */
    private $pipeline;

    /** @var CacheInterface */
    private $cache;

    /** @var SessionInterface */
    private $session;

    /** @var EventStreamInterface */
    private $eventstream;

    /** @var ResponderInterface */
    private $responder;

    /** @var TemplateEngineInterface */
    private $template_engine;

    /**
     * AbstractApplication constructor.
     *
     * @param FileSystemInterface $filesystem
     */
    public function __construct(FileSystemInterface $filesystem = null)
    {
        $this->filesystem = $filesystem ?? new NullFileSystem();
    }

    /**
     * Get application instance
     *
     * @return ApplicationInterface
     */
    public function application() : ApplicationInterface
    {
        return $this;
    }

    /**
     * Get file system
     *
     * @return FileSystemInterface
     */
    public function filesystem() : FileSystemInterface
    {
        return $this->filesystem;
    }

    /**
     * Require a module
     *
     * @param string $module_class
     *
     * @return ApplicationInterface
     */
    public function requireModule(string $module_class) : ApplicationInterface
    {
        if (!in_array($module_class, $this->required_modules)){
            $this->required_modules[] = $module_class;
        }
        return $this;
    }

    /**
     * Require a package
     *
     * @param string $package_class
     *
     * @return ApplicationInterface
     *
     * @throws PackageRequireException
     */
    public function requirePackage(string $package_class) : ApplicationInterface
    {
        if (!in_array(PackageInterface::class, class_implements($package_class))){
            throw new PackageRequireException('Specified package does not implements PackageInterface: ' . $package_class, $package_class);
        }

        $module_list = call_user_func([$package_class, 'getModuleList']);
        if (!is_array($module_list)){
            throw new PackageRequireException('Failed to call getModuleList: ' . $package_class, $package_class);
        }

        foreach($module_list as $module){
            if (!in_array($module, $this->required_modules)){
                $this->required_modules[] = $module;
            }
        }

        return $this;
    }

    /**
     * Get list of required modules
     *
     * @return string[]
     */
    public function getRequiredModules() : array
    {
        return $this->required_modules;
    }

    /**
     * Get list of installed modules
     *
     * @return ModuleInterface[]
     */
    public function getInstalledModules() : array
    {
        return $this->installed_modules;
    }

    /**
     * Add installed module
     *
     * @param string $module
     */
    public function addInstalledModule(string $module)
    {
        $this->installed_modules[] = $module;
    }

    /**
     * Resolve module dependencies
     *
     * @return string[]
     */
    public function getResolvedModules() : array
    {
        return $this->resolved_modules;
    }

    /**
     * {@inheritDoc}
     */
    public function setResolvedModules(array $modules)
    {
        $this->resolved_modules = $modules;
    }

    /**
     * Returns module factory classes
     *
     * @return ModuleFactoryInterface[]
     */
    protected function getModuleFactories() : array
    {
        return $this->module_factories;
    }

    /**
     * Add module factory
     *
     * @param ModuleFactoryInterface $module_factory
     *
     * @return ApplicationInterface
     */
    public function addModuleFactory(ModuleFactoryInterface $module_factory) : ApplicationInterface
    {
        $this->module_factories = $module_factory;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function configure() : ApplicationInterface
    {
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public abstract function install() : ApplicationInterface;

    /**
     * {@inheritDoc}
     */
    public abstract function installModules(array $modules) : ApplicationInterface;

    /**
     * execute application
     *
     * @throws
     */
    public function run() : ApplicationInterface
    {
        // install required modules
        $this->install();

        // execute pipeline
        $response = $this->executePipeline($this->pipeline(), $this->request());

        // process response
        $this->responder()->respond($response);

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @throws
     */
    private function executePipeline(PipelineInterface $pipeline, ServerRequestInterface $request) : ResponseInterface
    {
        if ($request instanceof NullRequest) {
            throw new ComponentNotInstalledException(Components::REQUEST);
        }
        if ($pipeline instanceof NullPipeline) {
            throw new ComponentNotInstalledException(Components::PIPELINE);
        }
        return $pipeline->run($request);
    }

    /**
     * {@inheritDoc}
     */
    public function addExceptionHandler(ExceptionHandlerInterface $handler) : ApplicationInterface
    {
        $this->ex_handlers[] = $handler;

        return $this;
    }

    /**
     * Handle exception
     *
     * @param Throwable $e
     */
    public function handleException(Throwable $e)
    {
        foreach($this->ex_handlers as $handler)
        {
            $handler->handleException($e);
        }
    }

    /**
     * Set/get logger
     *
     * @param LoggerInterface $logger
     *
     * @return LoggerInterface
     */
    public function logger(LoggerInterface $logger = null) : LoggerInterface
    {
        if ($logger){
            $this->logger = $logger;
        }
        if (!$this->logger){
            $this->logger = new NullLogger;
        }
        return $this->logger;
    }

    /**
     * Set/get router
     *
     * @param RouterInterface $router
     *
     * @return RouterInterface
     */
    public function router(RouterInterface $router = null) : RouterInterface
    {
        if ($router){
            $this->router = $router;
        }
        if (!$this->router){
            $this->router = new NullRouter;
        }
        return $this->router;
    }

    /**
     * Set/get di container
     *
     * @param DiContainerInterface $di
     *
     * @return DiContainerInterface
     */
    public function di(DiContainerInterface $di = null) : DiContainerInterface
    {
        if ($di){
            $this->di = $di;
        }
        if (!$this->di){
            $this->di = new NullDi;
        }
        return $this->di;
    }

    /**
     * Set/get request
     *
     * @param ServerRequestInterface $request
     *
     * @return ServerRequestInterface
     */
    public function request(ServerRequestInterface $request = null) : ServerRequestInterface
    {
        if ($request){
            $this->request = $request;
        }
        if (!$this->request){
            $this->request = new NullRequest;
        }
        return $this->request;
    }

    /**
     * Set/get response
     *
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function response(ResponseInterface $response = null) : ResponseInterface
    {
        if ($response){
            $this->response = $response;
        }
        if (!$this->response){
            $this->response = new NullResponse;
        }
        return $this->response;
    }

    /**
     * Set/get pipeline
     *
     * @param PipelineInterface $pipeline
     *
     * @return PipelineInterface
     */
    public function pipeline(PipelineInterface $pipeline = null) : PipelineInterface
    {
        if ($pipeline){
            $this->pipeline = $pipeline;
        }
        if (!$this->pipeline){
            $this->pipeline = new NullPipeline;
        }
        return $this->pipeline;
    }

    /**
     * Set/get cache
     *
     * @param CacheInterface $cache
     *
     * @return CacheInterface
     */
    public function cache(CacheInterface $cache = null) : CacheInterface
    {
        if ($cache){
            $this->cache = $cache;
        }
        if (!$this->cache){
            $this->cache = new NullCache;
        }
        return $this->cache;
    }

    /**
     * Set/get session
     *
     * @param SessionInterface $session
     *
     * @return SessionInterface
     */
    public function session(SessionInterface $session = null) : SessionInterface
    {
        if ($session){
            $this->session = $session;
        }
        if (!$this->session){
            $this->session = new NullSession;
        }
        return $this->session;
    }

    /**
     * Set/get event stream
     *
     * @param EventStreamInterface $eventstream
     *
     * @return EventStreamInterface
     */
    public function eventstream(EventStreamInterface $eventstream = null) : EventStreamInterface
    {
        if ($eventstream){
            $this->eventstream = $eventstream;
        }
        if (!$this->eventstream){
            $this->eventstream = new NullEventStream;
        }
        return $this->eventstream;
    }

    /**
     * Set/get responder
     *
     * @param ResponderInterface $responder
     *
     * @return ResponderInterface
     */
    public function responder(ResponderInterface $responder = null) : ResponderInterface
    {
        if ($responder){
            $this->responder = $responder;
        }
        if (!$this->responder){
            $this->responder = new NullResponder();
        }
        return $this->responder;
    }


    /**
     * Set/get template engine
     *
     * @param TemplateEngineInterface $engine
     *
     * @return TemplateEngineInterface
     */
    public function templateEngine(TemplateEngineInterface $engine = null) : TemplateEngineInterface
    {
        if ($engine){
            $this->template_engine = $engine;
        }
        if (!$this->template_engine){
            $this->template_engine = new NullTemplateEngine();
        }
        return $this->template_engine;
    }

}