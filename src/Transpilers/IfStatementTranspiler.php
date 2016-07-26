<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Stmt\If_;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\TabLevelBuffer;
use Glena\PhpJs\Scope;

class IfStatementTranspiler { 

  public function process(If_ $statement, Buffer $buffer, Scope $scope) {
    $buffer->append("if (");

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
    $buffer->newLine();

    if (!empty($statement->elseifs)) {
      foreach($statement->elseifs as $elseif) {
        $transpiler = TranspilerFactory::build(get_class($elseif));
        $transpiler->process($elseif, $buffer, $scope);
      }
    }

    if (!empty($statement->else)) {
      $transpiler = TranspilerFactory::build(get_class($statement->else));
      $transpiler->process($statement->else, $buffer, $scope);
    }
  }

}