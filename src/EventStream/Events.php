<?php
namespace KnotLib\Kernel\EventStream;

final class Events
{
    private const PREFIX                         = 'calgamo.kernel.';

    // env events
    const ENV_LOADED                     = self::PREFIX . 'env.loaded';

    // cache events
    const CACHE_ATTACHED                 = self::PREFIX . 'cache.attached';

    // logger events
    const LOGGER_ATTACHED                = self::PREFIX . 'logger.attached';
    const LOGGER_CHANNEL_CREATED         = self::PREFIX . 'logger.channel.created';

    // router events
    const ROUTER_ATTACHED                = self::PREFIX . 'router.attached';
    const ROUTER_ROUTED                  = self::PREFIX . 'router.routed';
    const ROUTER_DISPATCHED              = self::PREFIX . 'router.dispatched';

    // exception handler events
    const EX_HANDLER_ADDED               = self::PREFIX . 'ex_handler.added';

    // request events
    const REQUEST_ATTACHED               = self::PREFIX . 'request.attached';

    // response events
    const RESPONSE_ATTACHED              = self::PREFIX . 'response.attached';

    // session events
    const SESSION_ATTACHED               = self::PREFIX . 'session.attached';

    // di events
    const DI_ATTACHED                    = self::PREFIX . 'di.attached';

    // pipeline events
    const PIPELINE_ATTACHED              = self::PREFIX . 'pipeline.attached';
    const PIPELINE_MIDDLEWARE_PUSHED     = self::PREFIX . 'pipeline.middleware.pushed';

    // pipeline events
    const EVENTSTREAM_ATTACHED           = self::PREFIX . 'eventstream.attached';

    // responder events
    const RESPONDER_ATTACHED             = self::PREFIX . 'responder.attached';

    // module events
    const MODULE_INSTALLED               = self::PREFIX . 'module.installed';
}