<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Expr\Variable;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\Scope;

class VariableExpressionTranspiler { 

  public function process(Variable $statement, Buffer $buffer, Scope $scope, bool $canDefine = false) {
    if (! $scope->exists($statement->name)) {
      if ($canDefine) {
        $scope->add($statement->name);
        $buffer->append('var ');
      } else {
        throw new \Exception ('Var ' . $statement->name . ' not set.');
      }
    }
    $buffer->append($statement->name);
  }

}