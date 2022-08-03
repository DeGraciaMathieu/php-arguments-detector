<?php

namespace DeGraciaMathieu\PhpArgsDetector\Visitors;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;
use DeGraciaMathieu\PhpArgsDetector\NodeMethodExplorer;

class FileVisitor extends NodeVisitorAbstract
{
    private NodeMethodExplorer $nodeExplorer;

    private array $methods = [];

    public function __construct(NodeMethodExplorer $nodeExplorer)
    {
        $this->nodeExplorer = $nodeExplorer;
    }

    public function beforeTraverse(array $nodes): void
    {
        $this->methods = [];
    }

    public function leaveNode(Node $node): void
    {
        $this->methods[] = $this->nodeExplorer->get($node);
    }

    public function getMethods(): iterable
    {
        foreach ($this->methods as $method) {
            yield from $method;
        }
    }
}
