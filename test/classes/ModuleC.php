<?php
declare(strict_types=1);

namespace knotlib\kernel\test\classes;

use knotlib\kernel\module\ComponentTypes;
use knotlib\kernel\module\ModuleInterface;
use knotlib\kernel\kernel\ApplicationInterface;

class ModuleC implements ModuleInterface
{
    /** @var string */
    private $name;

    /**
     * ModuleC constructor.
     *
     * @param string $name
     */
    public function __construct(string $name = 'Peter')
    {
        $this->name = $name;
    }

    /**
     * Declare dependency on another modules
     *
     * @return array
     */
    public static function requiredModules() : array
    {
        return [
            ModuleA::class,
            ModuleB::class,
        ];
    }

    /**
     * Declare dependency on components
     *
     * @return array
     */
    public static function requiredComponentTypes() : array
    {
        return [
            ComponentTypes::EX_HANDLER,
            ComponentTypes::LOGGER,
            ComponentTypes::EVENTSTREAM,
        ];
    }

    /**
     * Declare component type of this module
     *
     * @return string
     */
    public static function declareComponentType() : string
    {
        return ComponentTypes::APPLICATION;
    }

    /**
     * Install module
     *
     * @param ApplicationInterface $app
     */
    public function install(ApplicationInterface $app)
    {
        echo 'ModuleC is installed.';
    }

    public function __toString()
    {
        return 'My name is: ' . $this->name;
    }
}