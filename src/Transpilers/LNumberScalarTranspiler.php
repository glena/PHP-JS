<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Scalar\LNumber;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\Scope;

class LNumberScalarTranspiler { 

  public function process(LNumber $statement, Buffer $buffer, Scope $scope) {

    $buffer->append($statement->value);

  }

}