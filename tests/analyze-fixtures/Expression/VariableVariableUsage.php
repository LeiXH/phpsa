<?php

namespace Tests\Compiling\Statements;

class VariableVariableUsage
{
    /**
     * @return string
     */
    public function simpleVariableVariable()
    {
        $varName = 'name';

        ${$varName} = 'foo';

        return $name;
    }

    /**
     * @return string
     */
    public function variableVariableInArrayAssignment()
    {
        $array = [];
        $varName = 'array';

        ${$varName}[] = 'foo';
        $array[] = 'bar';

        return $array;
    }

    /**
     * @return string
     */
    public function variableVariableInListAssignment()
    {
        $a = 'foo';
        list(${$a}, $b) = [1, 2];

        return $foo;
    }

    /**
     * @return string
     */
    public function propertyAccessVariable()
    {
        $varName = 'name';

        $this->{$varName} = 'foo';

        return $name;
    }

    /**
     * @return string
     */
    public function arrayPropertyAccessVariable()
    {
        $varName = 'name';

        $this->{$varName}[] = 'foo';

        return $name;
    }
}
?>
----------------------------
[
    {
        "type": "variable.dynamic_assignment",
        "message": "Dynamic assignment is greatly discouraged.",
        "file": "VariableVariableUsage.php",
        "line": 13
    },
    {
        "type": "variable.dynamic_assignment",
        "message": "Dynamic assignment is greatly discouraged.",
        "file": "VariableVariableUsage.php",
        "line": 26
    },
    {
        "type": "variable.dynamic_assignment",
        "message": "Dynamic assignment is greatly discouraged.",
        "file": "VariableVariableUsage.php",
        "line": 38
    },
    {
        "type": "variable.dynamic_assignment",
        "message": "Dynamic assignment is greatly discouraged.",
        "file": "VariableVariableUsage.php",
        "line": 50
    },
    {
        "type": "variable.dynamic_assignment",
        "message": "Dynamic assignment is greatly discouraged.",
        "file": "VariableVariableUsage.php",
        "line": 62
    }
]
