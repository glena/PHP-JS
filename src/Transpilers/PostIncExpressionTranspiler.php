<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Expr\PostInc;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\Scope;

class PostIncExpressionTranspiler { 

  public function process(PostInc $statement, Buffer $buffer, Scope $scope) {

    $transpiler = TranspilerFactory::build(get_class($statement->var));
    $transpiler->process($statement->var, $buffer, $scope);

    $buffer->append( "++" );
    
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