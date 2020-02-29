<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Test\Component;

use KnotLib\Kernel\Module\ComponentTypes;
use KnotLib\Kernel\Module\ModuleInterface;
use KnotLib\Kernel\Kernel\ApplicationInterface;

class EventStreamModule implements ModuleInterface
{
    /**
     * ModuleInterface constructor.
     *
     * Module must not have any constructor parameters.
     */
    public function __construct()
    {
    }

    /**
     * Declare dependency on another modules
     *
     * @return array
     */
    public static function requiredModules() : array
    {
        return [
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
        ];
    }

    /**
     * Declare component type of this module
     *
     * @return string
     */
    public static function declareComponentType() : string
    {
        return ComponentTypes::EVENTSTREAM;
    }

    /**
     * Install module
     *
     * @param ApplicationInterface $app
     */
    public function install(ApplicationInterface $app)
    {
    }

}