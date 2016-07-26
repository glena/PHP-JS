<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Stmt\Function_;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\TabLevelBuffer;
use Glena\PhpJs\Scope;

class FunctionStatementTranspiler { 

  public function process(Function_ $statement, Buffer $buffer, Scope $scope) {
    $new_scope = new Scope($scope);

    $buffer->append("function ");
    $buffer->append($statement->name);
    $buffer->append(" (");

    foreach ($statement->params as $key => $param) {
      if ($key > 0) {
        $buffer->append( ", " );
      }
      $transpiler = TranspilerFactory::build(get_class($param));
      $transpiler->process($param, $buffer, $new_scope, true);
    }

    $buffer->append(")");
    $buffer->newLine();
    $buffer->append("{");

    $new_buffer = new TabLevelBuffer($buffer);

    foreach ($statement->stmts as $sub_stmt) {

      $new_buffer->newLine();
      $transpiler = TranspilerFactory::build(get_class($sub_stmt));
      $transpiler->process($sub_stmt, $new_buffer, $new_scope);

    }

    $buffer->newLine();
    $buffer->append("}");
  }

}