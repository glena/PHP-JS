<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Stmt\Return_;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\Scope;

class ReturnStatementTranspiler { 

  public function process(Return_ $statement, Buffer $buffer, Scope $scope) {
    $buffer->append("return ");

    $transpiler = TranspilerFactory::build(get_class($statement->expr));
    $transpiler->process($statement->expr, $buffer, $scope);
  }

}