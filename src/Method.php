<?php

namespace DeGraciaMathieu\PhpArgsDetector;

use Symfony\Component\Finder\SplFileInfo;

class Method
{
    public function __construct(SplFileInfo $file, string $name, int $line, $parameters)
    {
        $this->file = $file;
        $this->name = $name;
        $this->line = $line;
        $this->parameters = $parameters;
    }

    public function getFile(): SplFileInfo
    {
        return $this->file;
    }

    public function getLine(): int
    {
        return $this->line;
    }

    public function getParameters()
    {
        return $this->parameters;
    }
}
