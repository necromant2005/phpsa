<?php
/**
 * Created by PhpStorm.
 * User: ovr
 * Date: 20.06.15
 * Time: 16:28
 */

namespace PHPSA;

use PHPSA\Definition\ClassDefinition;
use Symfony\Component\Console\Output\OutputInterface;

class Context
{
    /**
     * @var ClassDefinition
     */
    public $scope;

    /**
     * @var Application
     */
    public $application;

    /**
     * @var OutputInterface
     */
    public $output;

    public function notice($type, $message, \PhpParser\NodeAbstract $expr)
    {
        $code = file(__DIR__ . '/../tests/simple/test-1/1.php');

        $this->output->writeln('<comment>Notice:  ' . $message . "  in  tests/simple/test-1/1.php on {$expr->getLine()} [{$type}]</comment>");
        $this->output->writeln('');

        $code = trim($code[$expr->getLine()-1]);
        $this->output->writeln("<comment>\t {$code} </comment>");
    }
}