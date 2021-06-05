<?php
declare(strict_types=1);

namespace knotlib\kernel\module;

use knotlib\kernel\kernel\ApplicationInterface;

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
    public function createModule(string $module_class, ApplicationInterface $app)
    {
        $ret = ($this->callable)($module_class, $app);
        if ($ret instanceof ModuleInterface){
            return $ret;
        }
        return null;
    }
}