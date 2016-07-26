<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Expr\FuncCall;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\Scope;

class FuncCallExpressionTranspiler { 

  public function process(FuncCall $statement, Buffer $buffer, Scope $scope) {

    $buffer->append( $this->processFuncName($statement->name) );
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

  protected function processFuncName ($name) {
    switch ($name) {
      case 'var_dump':
        $name = 'console.log';
        break;
    }
    return $name;
  }

}