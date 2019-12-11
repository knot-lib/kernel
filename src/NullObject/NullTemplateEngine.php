<?php
declare(strict_types=1);

namespace KnotLib\Kernel\NullObject;

use KnotLib\Kernel\FileSystem\FileSystemInterface;
use KnotLib\Kernel\TemplateEngine\TemplateEngineInterface;

final class NullTemplateEngine implements TemplateEngineInterface
{
    /**
     * {@inheritDoc}
     */
    public function init(FileSystemInterface $fs)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function render(string $page_key, array $values)
    {
    }
}