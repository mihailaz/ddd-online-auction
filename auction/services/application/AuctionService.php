<?php
/**
 * User: Michael Lazarev <mv.lazarev@jet.msk.su>
 * Date: 13.09.17 10:27
 */

namespace auction\services\application;

use auction\aggregates\AuctionAggregate;
use auction\services\infrastructure\repositories\AuctionRepositoryInterface;

class AuctionService implements AuctionServiceInterface
{
	/**
	 * @var AuctionRepositoryInterface
	 */
	private $auctionRepository;

	public function __construct(AuctionRepositoryInterface $auctionRepository)
	{
		$this->auctionRepository = $auctionRepository;
	}

	public function announceAuction($itemId)
	{
		$auction = new AuctionAggregate($itemId);

		$this->auctionRepository->persistent($auction);
	}

	public function closeAuction($auctionId)
	{
		$auction = $this->auctionRepository->findById($auctionId);
		$auction->close();

		$this->auctionRepository->persistent($auction);
	}
}
