<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Stmt\For_;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\TabLevelBuffer;
use Glena\PhpJs\Scope;

class ForStatementTranspiler { 

  public function process(For_ $statement, Buffer $buffer, Scope $scope) {
    $buffer->append("for (");
    
    foreach($statement->init as $stmt) {
      $transpiler = TranspilerFactory::build(get_class($stmt));
      $transpiler->process($stmt, $buffer, $scope);
    }

    $buffer->append("; ");

    foreach($statement->cond as $stmt) {
      $transpiler = TranspilerFactory::build(get_class($stmt));
      $transpiler->process($stmt, $buffer, $scope);
    }

    $buffer->append("; ");

    foreach($statement->loop as $stmt) {
      $transpiler = TranspilerFactory::build(get_class($stmt));
      $transpiler->process($stmt, $buffer, $scope);
    }

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

  }

}