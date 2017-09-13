<?php
/**
 * User: Michael Lazarev <mv.lazarev@jet.msk.su>
 * Date: 13.09.17 10:25
 */

namespace auction\aggregates;

use auction\entities\Bid;
use auction\valueObjects\ItemId;
use common\Aggregate;

class AuctionAggregate extends Aggregate implements AuctionAggregateInterface
{
	const CLOSE = 1;
	const OPEN = 0;

	private $itemId;
	private $status;
	/**
	 * @var Bid[]
	 */
	private $bids = [];
	private $closedAt;

	public function __construct($itemId)
	{
		if (!$itemId instanceof ItemId) {
			$itemId = new ItemId($itemId);
		}
		$this->itemId = $itemId;
	}

	public function close()
	{
		$maxBid = $this->getMaxBid();

		if (!$maxBid) {
			throw new \Exception('Max bids not found');
		}

		$this->status = self::CLOSE;
		$this->closedAt = new \DateTime();
		$maxBid->win();
	}
	
	public function makeBid($price)
	{
		$this->bids[] = new Bid(null, $price);
	}

	public function getMaxBid()
	{
		/**
		 * @var Bid $maxBid
		 */
		$maxBid = null;

		foreach ($this->bids as $bid) {
			if (!$maxBid) {
				$maxBid = $bid;
			} else {
				$maxBid = $maxBid->max($bid);
			}
		}

		return $maxBid;
	}
}
