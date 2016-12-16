<?php

namespace Tests\PHPSA\Compiler\Expression\Operators;

use PhpParser\Node;
use PHPSA\CompiledExpression;
use PHPSA\Compiler\Expression;
use PHPSA\Variable;

/**
 * Class PreDecTest
 * @package Tests\PHPSA\Expression\BinaryOp
 */
class PreDecTest extends \Tests\PHPSA\TestCase
{
    /**
     * @return array
     */
    public function getDataProviderForSuccess()
    {
        return [
            [-1],
            [1],
            [99],
            [0],
        ];
    }

    /**
     * @dataProvider getDataProviderForSuccess
     */
    public function testSuccessFromDataProvider($value)
    {
        $testVariableName = 'myTestVariable';

        $context = $this->getContext();
        $context->addVariable(new Variable($testVariableName, $value, CompiledExpression::INTEGER));

        $baseExpression = new Node\Expr\PreDec(
            new Node\Expr\Variable(
                new Node\Name($testVariableName)
            )
        );
        $compiledExpression = $this->compileExpression($baseExpression, $context);

        $this->assertInstanceOfCompiledExpression($compiledExpression);
        $this->assertSame(CompiledExpression::INTEGER, $compiledExpression->getType());
        $this->assertSame(--$value, $compiledExpression->getValue());
    }

    /**
     * @return array
     */
    public function getDataProviderForSuccessDouble()
    {
        return [
            [-1.4],
            [1.4],
            [99.4],
            [0.4],
        ];
    }

    /**
     * @dataProvider getDataProviderForSuccessDouble
     */
    public function testSuccessDoubleFromDataProvider($value)
    {
        $testVariableName = 'myTestVariable';

        $context = $this->getContext();
        $context->addVariable(new Variable($testVariableName, $value, CompiledExpression::DOUBLE));

        $baseExpression = new Node\Expr\PreDec(
            new Node\Expr\Variable(
                new Node\Name($testVariableName)
            )
        );
        $compiledExpression = $this->compileExpression($baseExpression, $context);

        $this->assertInstanceOfCompiledExpression($compiledExpression);
        $this->assertSame(CompiledExpression::DOUBLE, $compiledExpression->getType());
        $this->assertSame(--$value, $compiledExpression->getValue());
    }
}
