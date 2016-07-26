<?php

namespace Glena\PhpJs;

class Buffer {

  protected $data = '';

  public function append($text) {
    $this->data .= $text;
  }

  public function newLine() {
    $this->data .= "\n";
  }

  public function get() {
    return $this->data;
  }

}