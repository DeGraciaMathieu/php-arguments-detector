<?php

namespace DeGraciaMathieu\PhpArgsDetector;

use Symfony\Component\Finder\SplFileInfo;

class Method
{
    protected $path;
    protected $name;
    protected $arguments;

    public function __construct(string $path, string $name, array $arguments)
    {
        $this->path = $path;
        $this->name = $name;
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

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function isConstructor(): bool
    {
        return $this->name === '__construct';
    }
}
