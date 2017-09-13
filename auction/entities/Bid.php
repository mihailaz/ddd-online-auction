<?php
/**
 * User: Michael Lazarev <mv.lazarev@jet.msk.su>
 * Date: 13.09.17 10:39
 */

namespace auction\entities;

use common\Entity;

class Bid extends Entity
{
	private $id;
	private $price;
	private $isWin = false;

	public function __construct($id, $price, $isWin = false)
	{
		$this->id = $id;
		$this->price = $price;
		$this->isWin = $isWin;
	}

	public function max(Bid $bid)
	{
		return $this->price > $bid->getPrice() ? $this : $bid;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function win()
	{
		$this->isWin = true;
	}
}
