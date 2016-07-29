# PHP-JS
A PHP to JS transpiler

Takes a [PHP file](blob/master/example.php) and converts it to [Javascript](blob/master/example.js).

## Disclaimer - This is a WIP

TODO:

- Handle traits, interfaces
- Handle namespaces
- Handle requires
- Handle imports when using autoload
- Handle closures
- Convert native functions (like strtolower to variable.toLowerCase)
- Provide a summary of undefined functions that needs to be defined
- A lot of things that I am not aware of

## Usage

```php
<?php

require 'vendor/autoload.php';

$file = $argv[1];
$code = file_get_contents($file);

$transpiler = new Glena\PhpJs\Transpiler();
$jsCode = $transpiler->transpile($code);

echo $jsCode;
```

### Input

```php
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
```

### Output

```js
function sum (a, b, c)
{
	return a + b + c
}
function append (a, b, capitalize)
{
	if (capitalize == true)
	{
		a = ucfirst(a)
	}
	else if (capitalize == false)
	{
		a = strtolower(a)
	}
	else
	{
		a = strtoupper(a)
	}
	
	return a + b
}
var total = sum(1, 2, 3)
var format = append("total ", total)
console.log(format)
for (var a = 0; a < 10; a++)
{
	console.log("a", a)
}

var b = 3
while (b > 0)
{
	b--
	console.log("b", b)
}
b = 3
while (b >= 0)
{
	b--
	console.log("b", b)
}
while (b <= 3)
{
	b++
	console.log("b", b)
}
var c = {"aa":1, "a":2, "aaa":3}

var objKeys = Object.Keys(c)
for (var key in objKeys)
{
	var number = key
	
	console.log(c)
}
c = [1, 2, 3]

for (number in c)
{
	console.log(c)
}
```
