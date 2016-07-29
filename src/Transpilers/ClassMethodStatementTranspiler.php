<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Stmt\ClassMethod;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\TabLevelBuffer;
use Glena\PhpJs\Scope;

class ClassMethodStatementTranspiler { 

  public function process(ClassMethod $statement, Buffer $buffer, Scope $scope, string $className) {
    $new_scope = new Scope($scope);

    $buffer->append($className);
    $buffer->append(".prototype.");
    $buffer->append($statement->name);
    $buffer->append(" = ");
    $buffer->append("function (");

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