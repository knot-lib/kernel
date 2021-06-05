<?php
declare(strict_types=1);

namespace knotlib\kernel\nullobject;

use knotlib\kernel\filesystem\FileSystemInterface;
use knotlib\kernel\templateengine\TemplateEngineInterface;

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