<?php

namespace Glena\PhpJs;

use Glena\PhpJs\Transpilers\TranspilerFactory;

class Processor {

  protected $buffer;
  protected $scope;
  protected $statements;

  public function __construct(array $statements, Buffer $buffer, Scope $scope) {

    $this->buffer = $buffer;
    $this->scope = $scope;
    $this->statements = $statements;

  }

  public function process() {
    foreach ($this->statements as $stmt) {
      $transpiler = TranspilerFactory::build(get_class($stmt));
      $transpiler->process($stmt, $this->buffer, $this->scope);

      $this->buffer->newLine();
    }
  }

}