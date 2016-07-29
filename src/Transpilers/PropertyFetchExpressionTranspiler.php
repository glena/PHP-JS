<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Expr\PropertyFetch;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\Scope;

class PropertyFetchExpressionTranspiler { 

  public function process(PropertyFetch $statement, Buffer $buffer, Scope $scope) {

    $transpiler = TranspilerFactory::build(get_class($statement->var));
    $transpiler->process($statement->var, $buffer, $scope);

    $buffer->append(".");

    $buffer->append($statement->name);

  }

}