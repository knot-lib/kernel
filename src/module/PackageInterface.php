<?php
declare(strict_types=1);

namespace knotlib\kernel\module;

interface PackageInterface
{
    /**
     * Get package module list
     *
     * @return string[]
     */
    public static function getModuleList() : array;
}