<?php

namespace App\Grpc;

use App\Model\BasketRepository;
use App\Model\CustomerBasket;
use GRPC\Basket\BasketInterface;
use GRPC\Basket\BasketItemResponse;
use GRPC\Basket\BasketRequest;
use GRPC\Basket\CustomerBasketRequest;
use GRPC\Basket\CustomerBasketResponse;
use Psr\Log\LoggerInterface;
use Spiral\RoadRunner\GRPC;

class BasketService implements BasketInterface
{
    private BasketRepository $repository;
    private LoggerInterface $logger;

    public function __construct(BasketRepository $repository, LoggerInterface $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger;
    }

    // TODO: Use logger info
    public function GetBasketById(GRPC\ContextInterface $ctx, BasketRequest $in): CustomerBasketResponse
    {
        $data = $this->repository->getBasket($in->getId());

        if ($data != null) {
            return $this->mapToCustomerBasketResponse($data);
        } else {
        }

        return new CustomerBasketResponse();
    }

    public function UpdateBasket(GRPC\ContextInterface $ctx, CustomerBasketRequest $in): CustomerBasketResponse
    {
        // TODO: Implement UpdateBasket() method.
        return new CustomerBasketResponse();
    }

    private function mapToCustomerBasketResponse(CustomerBasket $customerBasket): CustomerBasketResponse
    {
        $response = new CustomerBasketResponse();
        $response->setBuyerid($customerBasket->getBuyerid());

        $itemsResponse = [];
        foreach ($customerBasket->getItems() as $item) {
            $itemResponse = new BasketItemResponse();
            $itemResponse->setId($item->getId());
            $itemResponse->setProductid($item->getProductId());
            $itemResponse->setProductname($item->getProductName());
            $itemResponse->setUnitprice($item->getUnitprice());
            $itemResponse->setOldunitprice($item->getOldUnitprice());
            $itemResponse->setQuantity($item->getQuantity());
            $itemResponse->setPictureurl($item->getPictureurl());
            $itemsResponse[] = $itemResponse;
        }
        $response->setItems($itemsResponse);
        return $response;
    }

}
