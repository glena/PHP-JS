<?php

namespace Glena\PhpJs;

use PhpParser\ParserFactory;

class Transpiler {

  protected $parser;

  public function __construct($PHP_VERSION = ParserFactory::PREFER_PHP7) {

    $this->parser = (new ParserFactory)->create($PHP_VERSION);

  }

  public function transpile($code) : string {
    $stmts = $this->parser->parse($code);

    $buffer = new Buffer();
    $scope = new Scope();

    $processor = new Processor($stmts, $buffer, $scope);
    $processor->process();

    return $buffer->get();
  }

}