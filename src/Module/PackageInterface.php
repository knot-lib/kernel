<?php
namespace KnotLib\Kernel\Module;

interface PackageInterface
{
    /**
     * Get package module list
     *
     * @return string[]
     */
    public static function getModuleList() : array;
}