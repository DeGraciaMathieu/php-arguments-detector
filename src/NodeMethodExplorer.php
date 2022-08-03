<?php

namespace DeGraciaMathieu\PhpArgsDetector;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use Symfony\Component\Finder\SplFileInfo;
use DeGraciaMathieu\PhpArgsDetector\Method;

class NodeMethodExplorer
{
    private SplFileInfo $file;

    public function __construct(SplFileInfo $file)
    {
        $this->file = $file;
    }

    public function get(Node $node): iterable
    {
        if ($this->isNotClassMethod($node)) {
            return;
        }

        yield new Method(
            $this->file, 
            $node->name->name, 
            $node->getLine(), 
            $node->getParams(),
        );
    }

    public function isNotClassMethod(Node $node): bool
    {
        return ! $node instanceof ClassMethod;
    }
}
