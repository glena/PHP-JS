<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Stmt\Class_;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\TabLevelBuffer;
use Glena\PhpJs\Scope;

class ClassStatementTranspiler { 

  public function process(Class_ $statement, Buffer $buffer, Scope $scope) {

    $properties = [];
    $methods = [];
    $constructor = null;

    foreach ($statement->stmts as $stmt) {
      if ($stmt instanceof \PhpParser\Node\Stmt\Property) {
        $properties[] = $stmt;
      }
      if ($stmt instanceof \PhpParser\Node\Stmt\ClassMethod) {
        if ($stmt->name === '__construct') {
          $constructor = $stmt;
        } else {
          $methods[] = $stmt;
        }
      }
    }

    $buffer->append("var ");
    $buffer->append($statement->name);
    $buffer->append(" = function (");

    $new_scope = new Scope($scope);

    if ($constructor) {
      foreach ($constructor->params as $key => $param) {
        if ($key > 0) {
          $buffer->append( ", " );
        }
        $new_scope->add($param->name);
        $transpiler = TranspilerFactory::build(get_class($param));
        $transpiler->process($param, $buffer, $new_scope);
      }
    }

    $buffer->append(")");
    $buffer->newLine();
    $buffer->append("{");

    $new_buffer = new TabLevelBuffer($buffer);
    $new_buffer->newLine();

    foreach ($properties as $property) {
      foreach ($property->props as $prop) {

        // TODO map private and protect
        switch ($property->type) {
          case 1: // protected
            $new_buffer->append("this.");
            break;

          case 2: // public
            $new_buffer->append("this.");
            break;

          case 4: // private
            $new_buffer->append("this.");
            break;
          
          default:
            throw new \Exception('Invalid property type: ' . $property->type);
            break;
        }

        $new_scope->add($prop->name);

        $transpiler = TranspilerFactory::build(get_class($prop));
        $transpiler->process($prop, $new_buffer, $scope);

      }
    }

    if ($constructor) {
      foreach ($constructor->stmts as $sub_stmt) {
        $new_buffer->newLine();
        $transpiler = TranspilerFactory::build(get_class($sub_stmt));
        $transpiler->process($sub_stmt, $new_buffer, $new_scope);
      }
    }
    

    $buffer->newLine();
    $buffer->append("}");

    foreach ($methods as $sub_stmt) {
      $buffer->newLine();
      $transpiler = TranspilerFactory::build(get_class($sub_stmt));
      $transpiler->process($sub_stmt, $buffer, $new_scope, $statement->name);
    }

  }

}