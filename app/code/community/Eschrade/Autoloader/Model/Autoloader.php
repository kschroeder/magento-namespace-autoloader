<?php

class Eschrade_Autoloader_Model_Autoloader
{
	
	protected static $registered = false;
	
	public function addAutoloader(Varien_Event_Observer $observer)
	{
		// this should not be necessary.  Just being done as a check
		if (self::$registered) {
			return;
		}
		spl_autoload_register(array($this, 'autoload'), false, true);
		self::$registered = true;
	}
	
	
	public function autoload($class)
	{
		$classFile = str_replace('\\', '/', $class) . '.php';
		// Only include a namespaced class.  This should leave the regular Magento autoloader alone 
		if (strpos($classFile, '/') !== false) {
			include $classFile;
		}
	}
	
}