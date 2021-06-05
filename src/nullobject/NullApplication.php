<?php
declare(strict_types=1);

namespace knotlib\kernel\nullobject;

use Throwable;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use knotlib\kernel\exception\KernelException;
use knotlib\kernel\kernel\ApplicationType;
use knotlib\kernel\kernel\ApplicationInterface;
use knotlib\kernel\filesystem\FileSystemInterface;
use knotlib\kernel\exceptionhandler\ExceptionHandlerInterface;
use knotlib\kernel\logger\LoggerInterface;
use knotlib\kernel\module\ModuleFactoryInterface;
use knotlib\kernel\router\RouterInterface;
use knotlib\kernel\di\DiContainerInterface;
use knotlib\kernel\pipeline\PipelineInterface;
use knotlib\kernel\cache\CacheInterface;
use knotlib\kernel\session\SessionInterface;
use knotlib\kernel\eventstream\EventStreamInterface;
use knotlib\kernel\responder\ResponderInterface;
use knotlib\kernel\templateengine\TemplateEngineInterface;
use knotlib\kernel\exception\ApplicationExecutionException;

final class NullApplication implements ApplicationInterface
{
    /**
     * NullApplication constructor.
     *
     * @param FileSystemInterface $filesystem
     */
    public function __construct(FileSystemInterface $filesystem = null)
    {
    }

    /**
     * {@inheritDoc}
     */
    public static function type() : ApplicationType
    {
        return ApplicationType::of(ApplicationType::CLI);
    }

    /**
     * {@inheritDoc}
     */
    public function filesystem() : FileSystemInterface
    {
        return new NullFileSystem();
    }

    /**
     * {@inheritDoc}
     */
    public function requireModule(string $module_class) : ApplicationInterface
    {
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function unrequireModule(string $module_class) : ApplicationInterface
    {
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function requirePackage(string $package_class) : ApplicationInterface
    {
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function unrequirePackage(string $package_class) : ApplicationInterface
    {
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRequiredModules() : array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function getInstalledModules() : array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function addInstalledModule(string $module)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getResolvedModules() : array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function setResolvedModules(array $modules)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getModuleFactory()
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function addModuleFactory(ModuleFactoryInterface $module_factory) : ApplicationInterface
    {
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
     *
     * @throws
     */
    public function install() : ApplicationInterface
    {
        throw new KernelException('Invalid operation on null application');
    }

    /**
     * {@inheritDoc}
     */
    public function installModule(string $module_class) : ApplicationInterface
    {
        throw new KernelException('Invalid operation on null application');
    }

    /**
     * {@inheritDoc}
     */
    public function run() : ApplicationInterface
    {
        throw new ApplicationExecutionException('Invalid operation on null application');
    }

    /**
     * {@inheritDoc}
     */
    public function addExceptionHandler(ExceptionHandlerInterface $handler) : ApplicationInterface
    {
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function handleException(Throwable $e)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function logger(LoggerInterface $logger = null) : LoggerInterface
    {
        return new NullLogger();
    }

    /**
     * {@inheritDoc}
     */
    public function router(RouterInterface $router = null) : RouterInterface
    {
        return new NullRouter();
    }

    /**
     * {@inheritDoc}
     */
    public function di(DiContainerInterface $di = null) : DiContainerInterface
    {
        return new NullDi();
    }

    /**
     * {@inheritDoc}
     */
    public function request(ServerRequestInterface $request = null) : ServerRequestInterface
    {
        return new NullRequest();
    }

    /**
     * {@inheritDoc}
     */
    public function response(ResponseInterface $response = null) : ResponseInterface
    {
        return new NullResponse();
    }

    /**
     * {@inheritDoc}
     */
    public function pipeline(PipelineInterface $pipeline = null) : PipelineInterface
    {
        return new NullPipeline();
    }

    /**
     * {@inheritDoc}
     */
    public function cache(CacheInterface $cache = null) : CacheInterface
    {
        return new NullCache();
    }

    /**
     * {@inheritDoc}
     */
    public function session(SessionInterface $session = null) : SessionInterface
    {
        return new NullSession();
    }

    /**
     * {@inheritDoc}
     */
    public function eventstream(EventStreamInterface $eventstream = null) : EventStreamInterface
    {
        return new NullEventStream();
    }

    /**
     * {@inheritDoc}
     */
    public function responder(ResponderInterface $responder = null) : ResponderInterface
    {
        return new NullResponder();
    }

    /**
     * {@inheritDoc}
     */
    public function templateEngine(TemplateEngineInterface $engine = null) : TemplateEngineInterface
    {
        return new NullTemplateEngine();
    }
}