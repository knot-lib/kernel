<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Module;

final class CallableModuleFactory implements ModuleFactoryInterface
{
    /** @var callable */
    private $callable;

    /**
     * CallableModuleFactory constructor.
     *
     * @param callable $callable
     */
    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    /**
     * {@inheritDoc}
     */
    public function createModule(string $module_class)
    {
        $ret = ($this->callable)($module_class);
        if ($ret instanceof ModuleInterface){
            return $ret;
        }
        return null;
    }
}