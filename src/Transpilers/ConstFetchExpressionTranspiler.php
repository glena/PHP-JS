<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Expr\ConstFetch;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\Scope;

class ConstFetchExpressionTranspiler { 

  public function process(ConstFetch $statement, Buffer $buffer, Scope $scope) {

    $transpiler = TranspilerFactory::build(get_class($statement->name));
    $transpiler->process($statement->name, $buffer, $scope, true);

  }

}