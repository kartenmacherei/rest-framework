<?php
namespace Kartenmacherei\RestFramework\Request;

use Kartenmacherei\RestFramework\EnsureException;

class Uri
{
    private $value = '';

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = rtrim($value, '/');
    }

    /**
     * @return string
     */
    public function asString(): string
    {
        return $this->value;
    }

    /**
     * @param Pattern $pattern
     * @return bool
     */
    public function matches(Pattern $pattern): bool
    {
        return preg_match($pattern->asString(), $this->value) === 1;
    }

    /**
     * @param int $index
     * @return string
     * @throws EnsureException
     * @throws UriException
     */
    public function getPathSegment(int $index): string
    {
        if ($index < 0) {
            throw new EnsureException('Index must not be negative');
        }
        $path = parse_url($this->value, PHP_URL_PATH);
        $parts = explode('/', trim($path, '/'));
        if (count($parts) <= $index) {
            throw new UriException(sprintf('URI does not have %d segments', $index));
        }
        return $parts[$index];
    }

}
