<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Arg;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\Scope;

class ArgNodeTranspiler { 

  public function process(Arg $statement, Buffer $buffer, Scope $scope, bool $canDefine = false) {
    $transpiler = TranspilerFactory::build(get_class($statement->value));
    $transpiler->process($statement->value, $buffer, $scope, $canDefine);
  }

}