<?php
declare(strict_types=1);

namespace knotlib\kernel\templateengine;

use knotlib\kernel\filesystem\FileSystemInterface;

interface TemplateEngineInterface
{
    /**
     * Initialize template system
     *
     * @param FileSystemInterface $fs
     */
    public function init(FileSystemInterface $fs);

    /**
     * Render page
     *
     * @param string $page_key
     * @param array $values
     */
    public function render(string $page_key, array $values);
}