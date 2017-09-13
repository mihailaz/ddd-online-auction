<?php
/**
 * User: Michael Lazarev <mv.lazarev@jet.msk.su>
 * Date: 13.09.17 10:47
 */

namespace auction\services\infrastructure\repositories;

use auction\aggregates\AuctionAggregateInterface;

interface AuctionRepositoryInterface
{
	public function persistent(AuctionAggregateInterface $aggregate);

	/**
	 * @param $auctionId
	 * @return AuctionAggregateInterface
	 */
	public function findById($auctionId);
}
