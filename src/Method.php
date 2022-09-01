<?php

namespace DeGraciaMathieu\PhpArgsDetector;

use Symfony\Component\Finder\SplFileInfo;

class Method
{
    protected $path;
    protected $name;
    protected $line;
    protected $arguments;

    public function __construct(string $path, string $name, int $line, array $arguments)
    {
        $this->path = $path;
        $this->name = $name;
        $this->line = $line;
        $this->arguments = $arguments;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLine(): int
    {
        return $this->line - 2;
    }

    public function countArguments(): int
    {
        return count($this->arguments);
    }

    public function getWeight(): int
    {
        $weight = $this->getLine() * $this->countArguments();

        return $weight > 0 ? $weight : 0;
    }

    public function isConstructor(): bool
    {
        return $this->name === '__construct';
    }
}
