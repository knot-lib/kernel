<?php
namespace KnotLib\Kernel\Module;

final class Components
{
    const MODULE      = 'module';
    const CACHE       = 'cache';
    const LOGGER      = 'logger';
    const ROUTER      = 'router';
    const EX_HANDLER  = 'ex_handler';
    const REQUEST     = 'request';
    const RESPONSE    = 'response';
    const SESSION     = 'session';
    const DI          = 'di';
    const PIPELINE    = 'pipeline';
    const EVENTSTREAM = 'eventstream';
    const RESPONDER   = 'responder';

    /**
     * Returns all defined component names
     *
     * @return array
     */
    public static function getDefinedComponents() : array
    {
        return [
            self::MODULE,
            self::CACHE,
            self::LOGGER,
            self::ROUTER,
            self::EX_HANDLER,
            self::REQUEST,
            self::RESPONSE,
            self::SESSION,
            self::DI,
            self::PIPELINE,
            self::EVENTSTREAM,
            self::RESPONDER,
        ];
    }

    /**
     * Check if component name is valid
     *
     * @param string $component_name
     *
     * @return bool
     */
    public static function isComponent(string $component_name) : bool
    {
        return in_array($component_name, self::getDefinedComponents());
    }
}