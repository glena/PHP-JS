<?php

namespace Glena\PhpJs;

class Scope {

  protected $parent;
  protected $definitions = [];

  public function __construct(Scope $parent = null) {
    $this->parent = (new EmptyScope());
  }

  public function exists($var) {
    return in_array($var, $this->definitions) || $this->parent->exists($var);
  }

  public function add($var) {
    if ($this->exists($var)) {
      return;
    }
    $this->definitions[] = $var;
    return;
  }

}