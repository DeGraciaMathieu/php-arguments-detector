<?php

namespace DeGraciaMathieu\PhpArgsDetector\Printers;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

class Console
{
    protected array $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function printData(OutputInterface $output, array $methods)
    {
        $rows = $this->getRows($methods);

        if (count($rows) === 0) {
            $output->writeln('<info>No methods found.</info>');
            return;
        }

        $this->printTable($output, $rows);

        $output->writeln('<info>Total of methods : ' . count($rows) . '</info>');

        return Command::SUCCESS;
    }

    protected function getRows(array $methods): array
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

            $rows[] = [
                $filename, 
                $method->name, 
                $count,
            ];
        }

        return $rows;
    }

    protected function printTable(OutputInterface $output, array $rows): void
    {
        $table = new Table($output);

        $table
            ->setHeaders(['Files', 'Methods', 'Arguments'])
            ->setRows($rows);

        $table->render();
    }
}
