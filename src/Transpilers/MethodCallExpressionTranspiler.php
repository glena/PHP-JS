<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Expr\MethodCall;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\Scope;

class MethodCallExpressionTranspiler { 

  public function process(MethodCall $statement, Buffer $buffer, Scope $scope) {

    $transpiler = TranspilerFactory::build(get_class($statement->var));
    $transpiler->process($statement->var, $buffer, $scope, true);

    $buffer->append(".");

    $buffer->append($statement->name);

    $buffer->append( "(" );

    foreach ($statement->args as $key => $arg) {
      if ($key > 0) {
        $buffer->append( ", " );
      }
      $transpiler = TranspilerFactory::build(get_class($arg));
      $transpiler->process($arg, $buffer, $scope);
    }

    $buffer->append( ")" );

  }

}