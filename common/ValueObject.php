<?php
/**
 * User: Michael Lazarev <mv.lazarev@jet.msk.su>
 * Date: 13.09.17 11:04
 */

namespace common;

abstract class ValueObject
{
	public function __construct(array $config = [])
	{
		foreach ($config as $attr => $value) {
			if (!property_exists($this, $attr)) {
				continue;
			}
			$this->{$attr} = $value;
		}
	}
}
