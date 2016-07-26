<?php

namespace Glena\PhpJs;

class TabLevelBuffer extends Buffer {
  protected $parent;

  public function __construct($buffer) {
    $this->parent = $buffer;
  }

  public function append($text) {
    $this->parent->append($text);
  }

  public function newLine() {
    $this->parent->newLine();
    $this->parent->append("\t");
  }

  public function get() {
    return $this->parent->get();
  }

}