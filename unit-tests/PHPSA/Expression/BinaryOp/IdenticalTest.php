<?php

namespace Tests\PHPSA\Expression\BinaryOp;

use PhpParser\Node;
use PHPSA\CompiledExpression;
use PHPSA\Visitor\Expression;

/**
 * Class IndenticalTest
 * @package Tests\PHPSA\Expression\BinaryOp
 */
class IndenticalTest extends \Tests\PHPSA\TestCase
{
    /**
     * @return array
     */
    public function testProviderForStaticIntToIntCases()
    {
        return array(
            array(-1, -1),
            array(-5, -5),
            array(-150, -150),
            array(150, 150),
            array(150, 150),
        );
    }

    /**
     * Tests (int) {left-expr} ==== (int) {right-expr}
     *
     * @param int $a
     * @param int $b
     *
     * @dataProvider testProviderForStaticIntToIntCases
     */
    public function testStaticIntToInt($a, $b)
    {
        $this->assertInternalType('int', $a);
        $this->assertInternalType('int', $b);

        $baseExpression = new Node\Expr\BinaryOp\Identical(
            new Node\Scalar\LNumber($a),
            new Node\Scalar\LNumber($b)
        );
        $compiledExpression = $this->compileExpression($baseExpression);

        $this->assertInstanceOf('PHPSA\CompiledExpression', $compiledExpression);
        $this->assertSame(CompiledExpression::BOOLEAN, $compiledExpression->getType());
        $this->assertSame(true, $compiledExpression->getValue());
    }

    /**
     * Tests (float) {left-expr} ==== (float) {right-expr}
     *
     * @param int $a
     * @param int $b
     *
     * @dataProvider testProviderForStaticIntToIntCases
     */
    public function testStaticFloatToFloat($a, $b)
    {
        $a = (float) $a;
        $b = (float) $b;

        $this->assertInternalType('double', $a);
        $this->assertInternalType('double', $b);

        $baseExpression = new Node\Expr\BinaryOp\Identical(
            /**
             * Cheating - float casting
             */
            new Node\Scalar\DNumber($a),
            new Node\Scalar\DNumber($b)
        );
        $compiledExpression = $this->compileExpression($baseExpression);

        $this->assertInstanceOf('PHPSA\CompiledExpression', $compiledExpression);
        $this->assertSame(CompiledExpression::BOOLEAN, $compiledExpression->getType());
        $this->assertSame(true, $compiledExpression->getValue());
    }

    public function testProviderForStaticIntToFloatCases()
    {
        return array(
            array(-1, -1.0),
            array(-5, -5.0),
            array(-150, -150.0),
            array(150, 150.0),
            array(150, 150.0),
        );
    }

    /**
     * Tests (int) {left-expr} ==== (float) {right-expr}
     *
     * @param int $a
     * @param int $b
     *
     * @dataProvider testProviderForStaticIntToIntCases
     */
    public function testStaticFailIntToFloat($a, $b)
    {
        $b = (float) $b;

        $this->assertInternalType('int', $a);
        $this->assertInternalType('double', $b);

        $baseExpression = new Node\Expr\BinaryOp\Identical(
            new Node\Scalar\LNumber($a),
            new Node\Scalar\DNumber($b)
        );
        $compiledExpression = $this->compileExpression($baseExpression);

        $this->assertInstanceOf('PHPSA\CompiledExpression', $compiledExpression);
        $this->assertSame(CompiledExpression::BOOLEAN, $compiledExpression->getType());
        $this->assertSame(false, $compiledExpression->getValue());
    }

    /**
     * Tests (float) {left-expr} ==== (int) {right-expr}
     *
     * @param int $a
     * @param int $b
     *
     * @dataProvider testProviderForStaticIntToIntCases
     */
    public function testStaticFailFloatToInt($a, $b)
    {
        $a = (float) $a;

        $this->assertInternalType('double', $a);
        $this->assertInternalType('int', $b);

        $baseExpression = new Node\Expr\BinaryOp\Identical(
            new Node\Scalar\DNumber($a),
            new Node\Scalar\LNumber($b)
        );
        $compiledExpression = $this->compileExpression($baseExpression);

        $this->assertInstanceOf('PHPSA\CompiledExpression', $compiledExpression);
        $this->assertSame(CompiledExpression::BOOLEAN, $compiledExpression->getType());
        $this->assertSame(false, $compiledExpression->getValue());
    }
}
