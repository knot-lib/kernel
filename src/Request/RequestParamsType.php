<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Request;

final class RequestParamsType
{
    //===================================
    // Console
    //===================================
    const CONSOLE_ORDERED              = 'ordered';
    const CONSOLE_NAMED                = 'named';

    //===================================
    // Server Request
    //===================================
    const SERVER_REQUEST_POST          = 'post';
    const SERVER_REQUEST_GET           = 'get';
    const SERVER_REQUEST_COOKIES       = 'cookies';
    const SERVER_REQUEST_FILES         = 'files';
    const SERVER_REQUEST_SERVER        = 'server';
}