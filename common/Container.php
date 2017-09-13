<?php
/**
 * User: Michael Lazarev <mv.lazarev@jet.msk.su>
 * Date: 13.09.17 11:10
 */

namespace common;

class Container
{
	private $mapping = [

	];

	public function get($interface, $params = [])
	{
		if (!array_key_exists($interface, $this->mapping)) {
			return null;
		}
		$class = $this->mapping[$interface];

		if (!class_exists($class)) {
			throw new \Exception('Unknown class: ' . $class);
		}
		if (!interface_exists($interface)) {
			throw new \Exception('Unknown interface: ' . $class);
		}
		if (!$class instanceof $interface) {
			throw new \Exception('Invalid class: ' . $class);
		}

		return $this->instate($class, $params);
	}

	public function set($interface, $class)
	{
		if (!class_exists($class)) {
			throw new \Exception('Unknown class: ' . $class);
		}
		if (!$class instanceof $interface) {
			throw new \Exception('Invalid class: ' . $class);
		}
		$this->mapping[$interface] = $class;
	}

	private function instate($class, $aParams = [])
	{
		if (!class_exists($class)) {
			throw new \Exception('Unknown class: ' . $class);
		}
		$ref = new \ReflectionClass($class);
		$cons = $ref->getConstructor();

		if (!$cons) {
			return new $class;
		}
		$params = $cons->getParameters();
		$args = [];
		/** @var \ReflectionParameter $param */
		foreach ($params as $param) {
			if ($param->isDefaultValueAvailable() && !$aParams) {
				$arg = $param->getDefaultValue();
			} else {
				$type = $param->getType();

				if (!$type) {
					$arg = array_shift($aParams);
				} else {
					$arg = $this->get($type->getName());
				}
			}
			$args[] = $arg;
		}

		return $ref->newInstanceArgs($args);
	}
}
