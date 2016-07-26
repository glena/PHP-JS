<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Scalar\String_;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\Scope;

class StringScalarTranspiler { 

  public function process(String_ $statement, Buffer $buffer, Scope $scope) {

    $buffer->append('"');
    $buffer->append($statement->value);
    $buffer->append('"');

  }

}