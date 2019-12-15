<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Test;

use KnotLib\Kernel\Module\Components;
use KnotLib\Kernel\Module\ModuleInterface;
use KnotLib\Kernel\Kernel\ApplicationInterface;

class ModuleB implements ModuleInterface
{
    /** @var int */
    private $price;

    /**
     * ModuleB constructor.
     *
     * @param int $price
     */
    public function __construct(int $price = 0)
    {
        $this->price = $price;
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
        echo 'ModuleB is installed.';
    }

    public function __toString()
    {
        return 'This module\'s price is: $' . $this->price;
    }
}