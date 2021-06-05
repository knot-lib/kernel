<?php
declare(strict_types=1);

namespace knotlib\kernel\nullobject;

use Nyholm\Psr7\MessageTrait;
use Nyholm\Psr7\RequestTrait;
use Psr\Http\Message\ServerRequestInterface;

final class NullRequest implements ServerRequestInterface
{
    use MessageTrait;
    use RequestTrait;

    public function getServerParams()
    {
    }

    public function getCookieParams()
    {
    }

    public function withCookieParams(array $cookies)
    {
    }

    public function getQueryParams()
    {
    }

    public function withQueryParams(array $query)
    {
    }

    public function getUploadedFiles()
    {
    }

    public function withUploadedFiles(array $uploadedFiles)
    {
    }

    public function getParsedBody()
    {
    }

    public function withParsedBody($data)
    {
    }

    public function getAttributes()
    {
    }

    public function getAttribute($name, $default = null)
    {
    }

    public function withAttribute($name, $value)
    {
    }

    public function withoutAttribute($name)
    {
    }

}