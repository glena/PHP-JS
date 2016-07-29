<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Stmt\PropertyProperty;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\TabLevelBuffer;
use Glena\PhpJs\Scope;

class PropertyStatementTranspiler { 

  public function process(PropertyProperty $statement, Buffer $buffer, Scope $scope) {
    
    $buffer->append($statement->name);

    $buffer->append(' = ');

    if ($statement->default === null) {
      $buffer->append('null');
    } else {
      $transpiler = TranspilerFactory::build(get_class($statement->default));
      $transpiler->process($statement->default, $buffer, $scope, true);
    }

    $buffer->newLine();

  }

}