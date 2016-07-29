<?php

class DaClass {

  protected $da_property;
  private $da_property2;

  public $da_public_property;
  public $da_public_property2 = 10;

  public function __construct($value) {
    $this->da_property2 = $value;
  }

  public function Pepe() {
    $this->da_public_property = $this->pepe_2();
  }

  protected function pepe_2() {
    return $this->da_public_property2 * 2;
  }

}

$daInstance = new DaClass(10);
$daInstance->Pepe();
var_dump($daInstance->da_public_property);