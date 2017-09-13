<?php
/**
 * User: Michael Lazarev <mv.lazarev@jet.msk.su>
 * Date: 13.09.17 10:42
 */

namespace auction\services\infrastructure\repositories;

use auction\aggregates\AuctionAggregateInterface;

class AuctionRepository implements AuctionRepositoryInterface
{
	/**
	 * @param AuctionAggregateInterface $aggregate
	 * @return bool
	 */
	public function persistent(AuctionAggregateInterface $aggregate)
	{
		// todo

		return true;
	}

	/**
	 * @param int $auctionId
	 * @return AuctionAggregateInterface
	 */
	public function findById($auctionId)
	{

	}
}
