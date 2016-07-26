<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Stmt\ForEach_;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\TabLevelBuffer;
use Glena\PhpJs\Scope;

class ForEachExpressionTranspiler { 

  public function process(ForEach_ $statement, Buffer $buffer, Scope $scope) {

    $new_buffer = new TabLevelBuffer($buffer);

    if ($statement->keyVar === null) {
      $buffer->append("for (");

      $transpiler = TranspilerFactory::build(get_class($statement->valueVar));
      $transpiler->process($statement->valueVar, $buffer, $scope, true);

      $buffer->append(" in ");

      $transpiler = TranspilerFactory::build(get_class($statement->expr));
      $transpiler->process($statement->expr, $buffer, $scope);
      
      $buffer->append(")");
      $buffer->newLine();
      $buffer->append("{");
    } else {
      $buffer->append("var objKeys = Object.Keys(");
      $transpiler = TranspilerFactory::build(get_class($statement->expr));
      $transpiler->process($statement->expr, $buffer, $scope);
      $buffer->append(")");
      $buffer->newLine();

      $buffer->append("for (");
      
      $transpiler = TranspilerFactory::build(get_class($statement->keyVar));
      $transpiler->process($statement->keyVar, $buffer, $scope, true);

      $buffer->append(" in objKeys)");
      $buffer->newLine();
      $buffer->append("{");
      $new_buffer->newLine();
      $transpiler = TranspilerFactory::build(get_class($statement->valueVar));
      $transpiler->process($statement->valueVar, $new_buffer, $scope, true);

      $new_buffer->append(" = ");

      $transpiler = TranspilerFactory::build(get_class($statement->keyVar));
      $transpiler->process($statement->keyVar, $new_buffer, $scope);

      $new_buffer->newLine();
    }

    foreach ($statement->stmts as $sub_stmt) {

      $new_buffer->newLine();
      $transpiler = TranspilerFactory::build(get_class($sub_stmt));
      $transpiler->process($sub_stmt, $new_buffer, $scope);

    }

    $buffer->newLine();
    $buffer->append("}");
  }

}