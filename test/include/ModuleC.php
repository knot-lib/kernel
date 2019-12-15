<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Test;

use KnotLib\Kernel\Module\Components;
use KnotLib\Kernel\Module\ModuleInterface;
use KnotLib\Kernel\Kernel\ApplicationInterface;

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
    public static function requiredComponents() : array
    {
        return [
            Components::EX_HANDLER,
            Components::LOGGER,
            Components::EVENTSTREAM,
        ];
    }

    /**
     * Declare component type of this module
     *
     * @return string
     */
    public static function declareComponentType() : string
    {
        return Components::MODULE;
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