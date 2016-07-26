<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Expr\Assign;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\Scope;

class AssignExpressionTranspiler { 

  public function process(Assign $statement, Buffer $buffer, Scope $scope) {

    $transpiler = TranspilerFactory::build(get_class($statement->var));
    $transpiler->process($statement->var, $buffer, $scope, true);

    $buffer->append(" = ");

    $transpiler = TranspilerFactory::build(get_class($statement->expr));
    $transpiler->process($statement->expr, $buffer, $scope);

  }

}