<?php
declare(strict_types=1);

namespace knotlib\kernel\test\classes;

use knotlib\kernel\module\PackageInterface;

class PackageX implements PackageInterface
{
    /**
     * PackageD constructor.
     *
     * Module must not have any constructor parameters.
     */
    public function __construct()
    {
    }

    public static function getModuleList(): array
    {
        return [
            ModuleA::class, ModuleB::class,
        ];
    }


}