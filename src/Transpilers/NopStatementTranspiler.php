<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Stmt\Nop;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\TabLevelBuffer;
use Glena\PhpJs\Scope;

class NopStatementTranspiler { 

  public function process(Nop $statement, Buffer $buffer, Scope $scope) {

  }

}