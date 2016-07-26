<?php

namespace Glena\PhpJs;

class EmptyScope  extends Scope {

  public function __construct() {
  }

  public function define($var) {
    return;
  }

  public function exists($var) {
    return false;
  }

}