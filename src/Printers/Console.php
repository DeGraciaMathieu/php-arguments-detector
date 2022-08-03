<?php

namespace DeGraciaMathieu\PhpArgsDetector\Printers;

use DeGraciaMathieu\PhpArgsDetector\Method;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

class Console
{
    protected $options;

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

        $rows = $this->sortRows($rows);

        if ($this->options['limit']) {
            $rows = $this->cutRows($rows);
        }

        $this->printTable($output, $rows);

        $output->writeln('<info>Total of methods : ' . count($rows) . '</info>');

        return Command::SUCCESS;
    }

    protected function getRows(array $methods): array
    {
        $rows = [];

        foreach ($methods as $method) {

            if ($this->constructorIsUnwelcome($method)) {
                continue;
            }

            $count = count($method->getArguments());

            if ($this->outsideThresholds($count)) {
                continue;
            }

            $path = $method->getPath();

            $rows[] = [
                $path, 
                $method->getName(), 
                $count,
            ];
        }

        return $rows;
    }

    protected function constructorIsUnwelcome(Method $method): bool
    {
        return $this->options['without_constructor'] && $method->isConstructor();
    }

    protected function outsideThresholds(int $count): bool
    {
        return $this->belowTheThreshold($count) 
            || $this->aboveTheThreshold($count);
    }

    protected function belowTheThreshold(int $count): bool
    {
        return $this->options['min'] 
            && $count < (int) $this->options['min'];
    }

    protected function aboveTheThreshold(int $count): bool
    {
        return $this->options['max'] 
            && $count > (int) $this->options['max'];
    }

    protected function sortRows(array $rows): array
    {
        uasort($rows, function ($a, $b) {

            if ($a[2] == $b[2]) {
                return 0;
            }

            return ($a[2] < $b[2]) ? 1 : -1;
        });

        return $rows;
    }

    protected function cutRows(array $rows): array
    {
        $limit = $this->options['limit'];

        return array_slice($rows, 0, $limit);
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
