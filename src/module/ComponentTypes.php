<?php
declare(strict_types=1);

namespace knotlib\kernel\module;

final class ComponentTypes
{
    const CACHE         = 'cache';
    const LOGGER        = 'logger';
    const ROUTER        = 'router';
    const EX_HANDLER    = 'ex_handler';
    const REQUEST       = 'request';
    const RESPONSE      = 'response';
    const SESSION       = 'session';
    const DI            = 'di';
    const PIPELINE      = 'pipeline';
    const EVENTSTREAM   = 'eventstream';
    const RESPONDER     = 'responder';
    const SERVICE       = 'service';
    const MIDDLEWARE    = 'middleware';
    const APPLICATION   = 'application';
}