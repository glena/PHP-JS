<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Expr\New_;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\Scope;

class NewExpressionTranspiler { 

  public function process(New_ $statement, Buffer $buffer, Scope $scope) {

    $buffer->append('new ');

    $transpiler = TranspilerFactory::build(get_class($statement->class));
    $transpiler->process($statement->class, $buffer, $scope);

    $buffer->append('(');

    foreach ($statement->args as $key => $arg) {
      if ($key > 0) {
        $buffer->append( ", " );
      }
      $transpiler = TranspilerFactory::build(get_class($arg));
      $transpiler->process($arg, $buffer, $scope, true);
    }

    $buffer->append(')');

  }

}