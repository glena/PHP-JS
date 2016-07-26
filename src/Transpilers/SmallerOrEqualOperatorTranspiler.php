<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Expr\BinaryOp\SmallerOrEqual;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\Scope;

class SmallerOrEqualOperatorTranspiler { 

  public function process(SmallerOrEqual $statement, Buffer $buffer, Scope $scope) {

    $transpiler = TranspilerFactory::build(get_class($statement->left));
    $transpiler->process($statement->left, $buffer, $scope);

    $buffer->append(" <= ");

    $transpiler = TranspilerFactory::build(get_class($statement->right));
    $transpiler->process($statement->right, $buffer, $scope);

  }

}