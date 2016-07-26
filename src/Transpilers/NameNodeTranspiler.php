<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Name;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\Scope;

class NameNodeTranspiler { 

  public function process(Name $statement, Buffer $buffer, Scope $scope) {
    $buffer->append($statement->toString());
  }

}