<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Module;

use KnotLib\Kernel\Exception\InterfaceNotImplementedException;
use KnotLib\Kernel\Kernel\ApplicationInterface;

final class CascadedModuleFactory implements ModuleFactoryInterface
{
    /** @var ModuleFactoryInterface[] */
    private $child_factories = [];

    /**
     * CascadedModuleFactory constructor.
     *
     * @param array $child_factories
     *
     * @throws InterfaceNotImplementedException
     */
    public function __construct(array $child_factories)
    {
        foreach($child_factories as $factory){
            if (!($factory instanceof ModuleFactoryInterface)){
                throw  new InterfaceNotImplementedException($factory, ModuleInterface::class);
            }
            $this->child_factories[] = $factory;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function createModule(string $module_class, ApplicationInterface $app)
    {
        foreach($this->child_factories as $factory)
        {
            $ret = $factory->createModule($module_class, $app);
            if ($ret instanceof ModuleInterface){
                return $ret;
            }
        }
        return null;    // no child factory could create module instance.
    }


}