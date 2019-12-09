<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Kernel;

final class ApplicationType
{
    const CLI       = 'cli';
    const WEB_APP   = 'web_app';
    const API       = 'api';

    /** @var string */
    private $type;

    /**
     * ApplicationType constructor.
     *
     * @param string $type
     */
    private function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     * Returns application type object
     *
     * @param string $type
     *
     * @return ApplicationType
     */
    public static function of(string $type) : ApplicationType
    {
        static $map = [];
        if (!isset($map[$type])){
            $map[$type] = new self($type);
        }
        return $map[$type];
    }

    /**
     * Returns if type is the same as specified type
     *
     * @param string $type
     *
     * @return bool
     */
    public function is(string $type) : bool
    {
        return $this->type === $type;
    }

}