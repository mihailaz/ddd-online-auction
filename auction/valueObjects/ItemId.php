<?php
/**
 * User: Michael Lazarev <mv.lazarev@jet.msk.su>
 * Date: 13.09.17 12:28
 */

namespace auction\valueObjects;

use common\ValueObject;

class ItemId extends ValueObject
{
	protected $id;

	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	public function __toString()
	{
		return $this->getId();
	}
}
