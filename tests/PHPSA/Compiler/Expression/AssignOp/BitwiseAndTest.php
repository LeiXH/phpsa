<?php

namespace Tests\PHPSA\Compiler\Expression\AssignOp;

use PhpParser\Node;
use PHPSA\CompiledExpression;
use PHPSA\Compiler\Expression;

class BitwiseAndTest extends \Tests\PHPSA\TestCase
{
    /**
     * @return array
     */
    public function getDataProviderInteger()
    {
        return [
            [0, 5, 0],
            [1, 5, 1],
            [4, 5, 4],
            [-1, 5, 5],
            [1.4, 5, 1],
            [-19.7, 1, 1],
            [true, true, 1],
            [false, true, 0],
            [true, false, 0],
            [false, false, 0],
        ];
    }

    /**
     * Tests {var} &= {expr}
     *
     * @dataProvider getDataProviderInteger
     */
    public function testSimpleSuccessCompileInteger($a, $b, $c)
    {
        $baseExpression = new Node\Expr\AssignOp\BitwiseAnd(
            $this->newScalarExpr($a),
            $this->newScalarExpr($b)
        );
        $compiledExpression = $this->compileExpression($baseExpression);

        $this->assertInstanceOfCompiledExpression($compiledExpression);
        $this->assertSame(CompiledExpression::INTEGER, $compiledExpression->getType());
        $this->assertSame($c, $compiledExpression->getValue());
    }

    /**
     * tests variable type unknown
     */
    public function testUnexpectedTypeFirstArg()
    {
        $baseExpression = new Node\Expr\AssignOp\BitwiseAnd(
            $this->newFakeScalarExpr(),
            $this->newScalarExpr(1)
        );
        $compiledExpression = $this->compileExpression($baseExpression);

        $this->assertInstanceOfCompiledExpression($compiledExpression);
        $this->assertSame(CompiledExpression::UNKNOWN, $compiledExpression->getType());
        $this->assertSame(null, $compiledExpression->getValue());
    }

    public function testUnexpectedTypeSecondArg()
    {
        $baseExpression = new Node\Expr\AssignOp\BitwiseAnd(
            $this->newScalarExpr(1),
            $this->newFakeScalarExpr()
        );
        $compiledExpression = $this->compileExpression($baseExpression);

        $this->assertInstanceOfCompiledExpression($compiledExpression);
        $this->assertSame(CompiledExpression::UNKNOWN, $compiledExpression->getType());
        $this->assertSame(null, $compiledExpression->getValue());
    }
}
