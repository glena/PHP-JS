<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Param;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\Scope;

class ParamNodeTranspiler { 

  public function process(Param $statement, Buffer $buffer, Scope $scope) {
    $scope->add($statement->name);
    $buffer->append($statement->name);
  }

}