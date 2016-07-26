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
