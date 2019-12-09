<?php
namespace KnotLib\Kernel\Logger;

class Channels
{
    // default channel
    const DEFAULT              = 'default';

    // application channel
    const ERROR                = 'error';

    // primary objects channenls
    const CACHE                = 'cache';
    const DI                   = 'di';
    const EVENTSTREAM          = 'eventstream';
    const FILESYSTEM           = 'filesystem';
    const PIPELINE             = 'pipeline';
    const REPOSITORY           = 'repository';
    const REQUEST              = 'request';
    const RESPNDER             = 'responder';
    const RESPONSE             = 'response';
    const ROUTER               = 'router';
    const SESSION              = 'session';
    const TEMPLATE_ENGINE      = 'template_engine';
}