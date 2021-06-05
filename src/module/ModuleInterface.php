<?php
declare(strict_types=1);

namespace knotlib\kernel\module;

use knotlib\kernel\exception\ModuleInstallationException;
use knotlib\kernel\kernel\ApplicationInterface;

interface ModuleInterface
{
    /**
     * Declare dependency on another modules
     *
     * @return array
     */
    public static function requiredModules() : array;

    /**
     * Declare dependency on components
     *
     * @return array       array of ComponentTypes
     */
    public static function requiredComponentTypes() : array;

    /**
     * Declare component type of this module
     *
     * @return string
     */
    public static function declareComponentType() : string;

    /**
     * Install module
     *
     * @param ApplicationInterface $app
     *
     * @throws ModuleInstallationException
     */
    public function install(ApplicationInterface $app);
}