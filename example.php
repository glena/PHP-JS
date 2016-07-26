<?php

function sum($a, $b, $c = 0) {
  return $a + $b + $c;
}

function append($a, $b, $capitalize = true) {
  if ($capitalize == true) {
    $a = ucfirst($a);
  } elseif ($capitalize == false) {
    $a = strtolower($a);
  } else {
    $a = strtoupper($a);
  }
  return $a . $b;
}

$total = sum(1, 2, 3);
$format = append('total ', $total);

var_dump($format);

for ($a = 0; $a < 10; $a++) {
  var_dump("a",$a);
}

$b = 3;
while ($b > 0) {
  $b --;
  var_dump("b",$b);
}

$b = 3;
while ($b >= 0) {
  $b --;
  var_dump("b",$b);
}
while ($b <= 3) {
  $b ++;
  var_dump("b",$b);
}

$c = ["aa"=>1,"a"=>2,"aaa"=>3];
foreach($c as $key => $number) {
  var_dump($c);
}

$c = [1,2,3];
foreach($c as $number) {
  var_dump($c);
}