<?php
declare(strict_types=1);

namespace knotlib\kernel\kernel;

use knotlib\kernel\exception\InterfaceNotImplementedException;
use Throwable;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use knotlib\kernel\cache\CacheInterface;
use knotlib\kernel\di\DiContainerInterface;
use knotlib\kernel\eventstream\EventStreamInterface;
use knotlib\kernel\exception\ComponentNotInstalledException;
use knotlib\kernel\exceptionhandler\ExceptionHandlerInterface;
use knotlib\kernel\filesystem\FileSystemInterface;
use knotlib\kernel\logger\LoggerInterface;
use knotlib\kernel\module\ComponentTypes;
use knotlib\kernel\module\ModuleInterface;
use knotlib\kernel\module\PackageInterface;
use knotlib\kernel\module\ModuleFactoryInterface;
use knotlib\kernel\nullobject\NullCache;
use knotlib\kernel\nullobject\NullDi;
use knotlib\kernel\nullobject\NullEventStream;
use knotlib\kernel\nullobject\NullFileSystem;
use knotlib\kernel\nullobject\NullLogger;
use knotlib\kernel\nullobject\NullPipeline;
use knotlib\kernel\nullobject\NullRequest;
use knotlib\kernel\nullobject\NullResponder;
use knotlib\kernel\nullobject\NullResponse;
use knotlib\kernel\nullobject\NullRouter;
use knotlib\kernel\nullobject\NullSession;
use knotlib\kernel\nullobject\NullTemplateEngine;
use knotlib\kernel\pipeline\PipelineInterface;
use knotlib\kernel\responder\ResponderInterface;
use knotlib\kernel\router\RouterInterface;
use knotlib\kernel\session\SessionInterface;
use knotlib\kernel\templateengine\TemplateEngineInterface;

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

    /** @var bool */
    private $configured = false;

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
     * {@inheritDoc}
     */
    public function requireModule(string $module_class) : ApplicationInterface
    {
        if (!in_array($module_class, $this->required_modules)){
            $this->required_modules[] = $module_class;
        }
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function unrequireModule(string $module_class) : ApplicationInterface
    {
        $key = array_search($module_class, $this->required_modules);
        if ($key !== false){
            unset($this->required_modules[$key]);
            $this->required_modules = array_values($this->required_modules);
        }
        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @throws InterfaceNotImplementedException
     */
    public function requirePackage(string $package_class) : ApplicationInterface
    {
        if (!in_array(PackageInterface::class, class_implements($package_class))){
            throw new InterfaceNotImplementedException($package_class, PackageInterface::class);
        }

        $module_list = call_user_func([$package_class, 'getModuleList']);

        foreach($module_list as $module){
            if (!in_array($module, $this->required_modules)){
                $this->required_modules[] = $module;
            }
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @throws InterfaceNotImplementedException
     */
    public function unrequirePackage(string $package_class) : ApplicationInterface
    {
        if (!in_array(PackageInterface::class, class_implements($package_class))){
            throw new InterfaceNotImplementedException($package_class, PackageInterface::class);
        }

        $module_list = call_user_func([$package_class, 'getModuleList']);

        foreach($module_list as $module){
            $key = array_search($module, $this->required_modules);
            if ($key !== false){
                unset($this->required_modules[$key]);
                $this->required_modules = array_values($this->required_modules);
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
        $this->module_factories[] = $module_factory;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function configure() : ApplicationInterface
    {
        $this->configured = true;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public abstract function install() : ApplicationInterface;

    /**
     * {@inheritDoc}
     */
    public abstract function installModule(string $module_class) : ApplicationInterface;

    /**
     * execute application
     *
     * @throws
     */
    public function run() : ApplicationInterface
    {
        if (!$this->configured){
            $this->configure();
        }

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
            throw new ComponentNotInstalledException(ComponentTypes::REQUEST);
        }
        if ($pipeline instanceof NullPipeline) {
            throw new ComponentNotInstalledException(ComponentTypes::PIPELINE);
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