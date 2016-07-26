<?php

namespace Glena\PhpJs\Transpilers;

use PhpParser\Node\Expr\Array_;
use Glena\PhpJs\Buffer;
use Glena\PhpJs\Scope;

class ArrayExpressionTranspiler { 

  public function process(Array_ $statement, Buffer $buffer, Scope $scope) {
    $is_obj = true;

    foreach ($statement->items as $item) {
      if ($item->key === null || $item->key instanceof \PhpParser\Node\Scalar\LNumber) {
        $is_obj = false;
        break;
      }
    }

    if ($is_obj) {
      $this->is_obj($statement, $buffer, $scope);
    } else {
      $this->is_array($statement, $buffer, $scope);
    }

  }

  protected function is_array(Array_ $statement, Buffer $buffer, Scope $scope) {

    $buffer->append("[");

    foreach ($statement->items as $key => $item) {
      if ($key > 0) {
        $buffer->append( ", " );
      }
      $transpiler = TranspilerFactory::build(get_class($item->value));
      $transpiler->process($item->value, $buffer, $scope);
    }

    $buffer->append("]");

    echo $buffer->get();
  }

  protected function is_obj(Array_ $statement, Buffer $buffer, Scope $scope) {

    $buffer->append("{");

    foreach ($statement->items as $key => $item) {
      if ($key > 0) {
        $buffer->append( ", " );
      }
      $transpiler = TranspilerFactory::build(get_class($item->key));
      $transpiler->process($item->key, $buffer, $scope);

      $buffer->append( ":" );

      $transpiler = TranspilerFactory::build(get_class($item->value));
      $transpiler->process($item->value, $buffer, $scope);
    }

    $buffer->append("}");

    echo $buffer->get();
  }

}