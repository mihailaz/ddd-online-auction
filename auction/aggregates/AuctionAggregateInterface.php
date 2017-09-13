<?php
/**
 * User: Michael Lazarev <mv.lazarev@jet.msk.su>
 * Date: 13.09.17 10:59
 */

namespace auction\aggregates;

interface AuctionAggregateInterface
{
	public function close();
}
