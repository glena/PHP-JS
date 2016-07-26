<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Stmt\While_;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\TabLevelBuffer;
use Glena\PhpJs\Scope;

class WhileStatementTranspiler { 

  public function process(While_ $statement, Buffer $buffer, Scope $scope) {

    $buffer->append("while (");

    $transpiler = TranspilerFactory::build(get_class($statement->cond));
    $transpiler->process($statement->cond, $buffer, $scope);

    $buffer->append(")");
    $buffer->newLine();
    $buffer->append("{");

    $new_buffer = new TabLevelBuffer($buffer);

    foreach ($statement->stmts as $sub_stmt) {

      $new_buffer->newLine();
      $transpiler = TranspilerFactory::build(get_class($sub_stmt));
      $transpiler->process($sub_stmt, $new_buffer, $scope);

    }

    $buffer->newLine();
    $buffer->append("}");
  }

}