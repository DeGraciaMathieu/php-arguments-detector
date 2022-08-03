<?php

namespace DeGraciaMathieu\PhpArgsDetector\Printers;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

class Console
{
    protected array $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function printData(OutputInterface $output, array $methods): void
    {
        $rows = [];

        foreach ($methods as $method) {

            if ($this->options['without_constructor'] && $method->name === '__construct') {
                continue;
            }

            $count = count($method->parameters);

            if ($this->options['min'] && $count < (int) $this->options['min']) {
                continue;
            }

            if ($this->options['max'] && $count > (int) $this->options['max']) {
                continue;
            }

            $filename = $method->file->getRealPath();

            $rows[] = [$filename, $method->name, count($method->parameters)];
        }

        $table = new Table($output);

        $table
            ->setHeaders(['files', 'methods', 'Arguments'])
            ->setRows($rows);

        $table->render();

        $output->writeln('<info>Total of files : ' . count($rows) . '</info>');
    }
}
