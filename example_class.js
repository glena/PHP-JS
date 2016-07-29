var DaClass = function (value)
{
	this.da_property = null
	this.da_property2 = null
	this.da_public_property = null
	this.da_public_property2 = 10
	
	this.da_property2 = value
}
DaClass.prototype.Pepe = function ()
{
	this.da_public_property = this.pepe_2()
}
DaClass.prototype.pepe_2 = function ()
{
	return this.da_public_property2 * 2
}
var daInstance = new DaClass(10)
daInstance.Pepe()
console.log(daInstance.da_public_property)
